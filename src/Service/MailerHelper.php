<?php


namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class MailerHelper
 *
 * @package App\Service
 */
class MailerHelper
{
    /**
     * @var Swift_Mailer
     */
    protected $mailer;
    /**
     * @var Environment
     */
    private $template;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * MailerHelper constructor.
     *
     * @param Swift_Mailer $mailer
     * @param Environment $template
     * @param EntityManagerInterface $em
     */
    public function __construct(Swift_Mailer $mailer,
                                Environment $template,
                                EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->template = $template;
        $this->em = $em;
    }

    /**
     * @param $subject
     * @param $body
     * @param UserInterface $user
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function builtEmail($subject,$body, UserInterface $user)
    {
       $view = "emails/notification.html.twig";
        //$habilitation= "";
        $message = (new Swift_Message())
            ->setSubject($subject)
            ->setFrom($this->em->getRepository('User')->findOneByActif(true)->getEmail())
            ->setTo($user->getEmail())
            ->setBody(
                $this->template->render(
                // templates/emails/notification.html.twig
                    $view,
                    array('body' => $body)
                ),
                'text/html'
            );
        //dump($message);
        $this->mailer->send($message);
    }
    public function sendEmail(UserInterface $user)
    {
        $from = 'administrateur@aproximite.fr';
        $view = "emails/mailARregistration.html.twig";
        $objet= "Enregistrement du nouveau membre ".$user->getFullname();
        $this->em->flush();
        $message = (new \Swift_Message())
            ->setSubject($objet)
            ->setFrom($from)
            ->setTo($from)
            ->setBody(
                $this->template->render(
                    $view,
                    array('objet'=>$objet,'user'=>$user)
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}