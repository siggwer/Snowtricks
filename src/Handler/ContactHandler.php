<?php

namespace App\Handler;

use App\Form\ContactType;
use App\Model\Contact;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ContactHandler.
 */
class ContactHandler extends AbstractHandler
{
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
     * ContactHandler constructor.
     *
     * @param FlashBagInterface $flashBag
     * @param Swift_Mailer      $mailer
     * @param Environment       $templating
     */
    public function __construct(FlashBagInterface $flashBag, Swift_Mailer $mailer, Environment $templating)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->flashBag = $flashBag;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ContactType::class;
    }

    /**
     * @param Contact $data
     */
    public function process($data = null): void
    {
        $message = new Swift_Message();

        try {
            $message
                ->setTo('admin.snowtrick@yopmail.com', 'Contact snowtricks')
                ->setFrom('admin.snowtrick@yopmail.com', 'Contact snowtricks')
                ->setReplyTo($data->getEmail(), $data->getName())
                ->setBody(
                    $this->templating->render(
                        'contact/contact_email.html.twig',
                        [
                            'contact' => $data,
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
            'Votre message a bien été envoyé.
                 Nous répondrons dans un délais de 48 heures.'
        );
    }
}
