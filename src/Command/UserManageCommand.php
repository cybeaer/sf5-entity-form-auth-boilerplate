<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserManageCommand extends Command
{
    protected static $defaultName = 'user:manage';
    protected static $defaultDescription = 'admin cli user management';

    public function __construct(ContainerInterface $container,UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->hasher = $passwordHasher;
        $this->container = $container;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('cmd', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $cmd = $input->getArgument('cmd');
        $em = $this->container->get('doctrine')->getManager();
        if ($cmd) {
            switch($cmd){
                case 'add-root':
                    $user = new User();
                    $user->setUsername('root');
                    $plaintextPassword = 'secret-password';
                    $hashedPassword = $this->hasher->hashPassword(
                        $user,
                        $plaintextPassword
                    );
                    $user->setPassword($hashedPassword);
                    $em->persist($user);
                    $em->flush();
                    break;
                default:
                    $io->note(sprintf('You\'re passed an argument %s is unknown!', $cmd));
                    break;
            }
            
            //$io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        return Command::SUCCESS;
    }
}
