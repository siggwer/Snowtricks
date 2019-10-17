<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Services\Token;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Environment;
use Swift_Message;
use Swift_Mailer;
use App\Form\ForgotType;
use App\Model\Forgot;

/**
 * Class ForgotHandler
 *
 * @package App\Handler
 */
class ForgotHandler extends AbstractHandler
{
    /**
     * @var
     */
    private $userRepository;

    /**
     * @var Environment
     */
    private $templating;

    /**
     * @var Token
     */
    private $tokenService;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ForgotHandler constructor.
     *
     * @param UserRepository $userRepository
     * @param Token $tokenService
     * @param Environment $templating
     * @param Swift_Mailer $mailer
     * @param FlashBagInterface $flashBag
     */
    public function __construct(UserRepository $userRepository, Token $tokenService, Environment $templating, Swift_Mailer $mailer, FlashBagInterface $flashBag)
    {

        $this->userRepository = $userRepository;
        $this->tokenService = $tokenService;
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->flashBag = $flashBag;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ForgotType::class;
    }

    /**
     * @param Forgot $data
     *
     * @throws NonUniqueResultException
     */
    public function process($data = null): void
    {
        $user = $this->userRepository->checkEmail($data->getEmail());

        if ($data->getEmail() === $user->getEmail()) {

            $token = $this->tokenService::generateToken();

            $user = $this->userRepository->saveResetToken($data->getEmail(), $token);
            dd($user);
            $message = new Swift_Message();

            try {
                $message
                    ->setTo($data->getEmail(), 'Administrateur')
                    ->setFrom('admin.snowtrick@yopmail.com', 'Administrateur')
                    ->setReplyTo($data->getEmail())
                    ->setBody(
                        $this->templating->render(
                            'security/forgot/forgot_email.html.twig',
                            [
                                'forgot' => $data
                            ]
                        ),
                        'text/html'
                    );
            } catch (LoaderError $e) {
            } catch (RuntimeError $e) {
            } catch (SyntaxError $e) {
            }

            $this->mailer->send($message);

            $this->flashBag->add(
                'success',
                'Votre message a bien été envoyé.'
            );
       }
        $this->flashBag->add(
            'error',
            'Votre email n\'est pas reconnu'
        );
    }


}