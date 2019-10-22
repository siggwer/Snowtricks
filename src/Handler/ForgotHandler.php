<?php

namespace App\Handler;

use App\Event\ForgotPasswordEmailEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Doctrine\ORM\NonUniqueResultException;
use App\Repository\UserRepository;
use Doctrine\ORM\ORMException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Environment;
use Swift_Message;
use Swift_Mailer;
use App\Services\Token;
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
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

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
     * @param EventDispatcherInterface $eventDispatcher
     * @param FlashBagInterface $flashBag
     */
    public function __construct(UserRepository $userRepository, Token $tokenService, Environment $templating, Swift_Mailer $mailer,EventDispatcherInterface $eventDispatcher, FlashBagInterface $flashBag)
    {
        $this->userRepository = $userRepository;
        $this->tokenService = $tokenService;
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->eventDispatcher = $eventDispatcher;
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
     * @throws ORMException
     */
    public function process($data = null): void
    {
        $user = $this->userRepository->checkEmail($data->getEmail());

            if ($data->getEmail() === $user->getEmail()) {
                $token = $this->tokenService::generateToken();

                $this->userRepository->saveResetToken($data->getEmail(), $token);

                $passwordToken = $token;

                $this->eventDispatcher->dispatch(ForgotPasswordEmailEvent::NAME,
                    new ForgotPasswordEmailEvent($data->getEmail(), $token));

                $message = new Swift_Message();

                try {
                    $message
                        ->setTo($data->getEmail(), 'Administrateur')
                        ->setFrom('admin.snowtrick@yopmail.com', 'Administrateur')
                        ->setReplyTo($data->getEmail())
                        ->setSubject('Reinitialisation de votre compte')
                        ->setBody(
                            $this->templating->render(
                                'security/forgot/forgot_email.html.twig',
                                [
                                    'forgot' => $data,
                                    'passwordToken' => $passwordToken
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
                    'Un email t\'a été envoyé pour récupérer ton mot de passe.'
                );
            }
            $this->flashBag->add(
                'error',
                'Votre email n\'est pas reconnu'
            );
    }
}