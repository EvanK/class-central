<?php
namespace ClassCentral\SiteBundle\Command\Network;

use ClassCentral\SiteBundle\Command\Network\NetworkAbstractInterface;
use ClassCentral\SiteBundle\Entity\Offering;

class RedditNetwork extends NetworkAbstractInterface
{
    public function outInitiative( $stream , $offeringCount)
    {
//        if($initiative == null)
//        {
//            $name = 'Others';
//        }
//        else
//        {
//            $name = $initiative->getName();
//        }
        $name   = $stream->getName();
        $url = "http://www.class-central.com/stream/". $stream->getSlug();




        $this->output->writeln( strtoupper($name) . "({$offeringCount})");
        $this->output->writeln('');
               
    }

    public function beforeOffering()
    {
        // Table header row
        $this->output->writeln("Course Name|Start Date|Length");
        $this->output->writeln(":--|:--:|:--:");
    }


    public function outOffering(Offering $offering)
    {
        $name = '[' . $offering->getName(). ']' . '(' . $offering->getUrl() . ')';

        if($offering->getInitiative() == null)
        {
            $initiative = 'Others';
        }
        else
        {
            $initiative = $offering->getInitiative()->getName();
        }

        $startDate = 'NA';
        if($offering->getStatus() == Offering::START_DATES_KNOWN)
        {
            $startDate = $offering->getStartDate()->format('M jS');
        }
        else if ( $offering->getStatus() == Offering::COURSE_OPEN)
        {
            $startDate = 'Self Paced';
        }

        $length = 'NA';
        if(  $offering->getLength() != 0)
        {
            $length = $offering->getLength() . ' weeks';
        }

        $this->output->writeln("$name|$startDate|$length|$initiative");
    } 

}


