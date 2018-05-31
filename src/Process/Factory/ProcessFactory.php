<?php
/**
 * Class ProcessFactory
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Factory;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Validator\Process\AdditionFilter\AdditionFilterProcess;
use Validator\Process\Age\AgeProcess;
use Validator\Process\Counters\CountersProcess;
use Validator\Process\Gender\GenderProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Process\Price\PriceProcess;
use Validator\Process\Series\SeriesProcess;
use Validator\Process\Sorting\SortingProcess;
use Validator\Process\Stature\StatureProcess;
use Validator\Process\Stock\StockProcess;
use Validator\Process\Tag\TagProcess;

class ProcessFactory
{
    private $process = [];
    private $em;

    /**
     * ProcessFactory constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->process = new ArrayCollection();
    }
    /**
     * @param ProcessInterface $process
     */
    public function addProcess(ProcessInterface $process)
    {
        $this->process->add($process);
    }

    /**
     * @return $this
     */
    public function make()
    {
        $this->makeAdditionFilterProcess();
        $this->makeAgeProcess();
        $this->makeCountersProcess();
        $this->makeGenderProcess();
        $this->makePriceProcess();
        $this->makeSeriesProcess();
        $this->makeSortingProcess();
        $this->makeStatureProcess();
        $this->makeTagProcess();
        $this->makeStockProcess();

        return $this;
    }

    /**
     * @return ProcessInterface[]|ArrayCollection
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * Add Filters Process
     */
    private function makeAdditionFilterProcess()
    {
        $this->addProcess(new AdditionFilterProcess($this->em));
    }

    /**
     * Make Age process
     */
    private function makeAgeProcess()
    {
        $this->addProcess(new AgeProcess($this->em));
    }

    /**
     * Make counters process
     */
    private function makeCountersProcess()
    {
        $this->addProcess(new CountersProcess($this->em));
    }

    /**
     * Make gender process
     */
    private function makeGenderProcess()
    {
        $this->addProcess(new GenderProcess($this->em));
    }

    /**
     * Make price process
     */
    private function makePriceProcess()
    {
        $this->addProcess(new PriceProcess($this->em));
    }

    /**
     * Make Series process
     */
    private function makeSeriesProcess()
    {
        $this->addProcess(new SeriesProcess($this->em));
    }

    /**
     * Make sorting process
     */
    private function makeSortingProcess()
    {
        $this->addProcess(new SortingProcess($this->em));
    }

    /**
     * Make stature process
     */
    private function makeStatureProcess()
    {
        $this->addProcess(new StatureProcess($this->em));
    }

    /**
     * make stock process
     */
    private function makeStockProcess()
    {
        $this->addProcess(new StockProcess($this->em));
    }

    /**
     * make tag process
     */
    private function makeTagProcess()
    {
        $this->addProcess(new TagProcess($this->em));
    }


}