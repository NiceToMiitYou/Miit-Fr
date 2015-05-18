<?php

namespace Miit\CoreDomain\Team\CommandHandler;

use DomainDrivenDesign\Domain\Command\Command;
use DomainDrivenDesign\Domain\Command\CommandNotSupportedByHandler;

use Miit\CoreDomain\Team\Command\AddApplicationTeamCommand;

/**
 * Class AddApplicationTeamCommandHandler
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 */
final class AddApplicationTeamCommandHandler extends TeamCommandHandlerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        if($command instanceof AddApplicationTeamCommand) {

            $team = $this->teamRepository->findTeamByTeamId(
                $command->getTeamId()
            );

            if(null !== $team) {

                // Get the list of applications
                $applications = $command->getApplications();

                // For each applications
                foreach ($applications as $application) {
                    $team->addApplication($application);
                }

                // Persist the team
                $this->teamRepository->persist($team);
            }
        } else {

            throw new CommandNotSupportedByHandler($this, $command);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportedCommand()
    {
        return 'Miit\CoreDomain\Team\Command\AddApplicationTeamCommand';
    }
}
