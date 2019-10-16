<?php

namespace App\Handler;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
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
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Security
     */
    private $security;

    /**
     * @var Environment
     */
    private $templating;

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
     * @param Environment $templating
     * @param Swift_Mailer $mailer
     * @param FlashBagInterface $flashBag
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security, Environment $templating, Swift_Mailer $mailer, FlashBagInterface $flashBag)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
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
     */
    public function process($data = null): void
    {
        $user = $this->entityManager->getPartialReference(User::class, $data->getEmail());
        if ($data->getEmail() === $user) {
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