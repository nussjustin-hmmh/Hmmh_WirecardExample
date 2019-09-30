<?php declare(strict_types=1);

namespace Hmmh\WirecardExample\Console\Command;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Phrase;
use Magento\Framework\Phrase\Renderer\Translate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var Translate
     */
    private $renderer;

    /**
     * Example constructor.
     * @param ObjectManagerInterface $objectManager
     * @param Translate $renderer
     */
    public function __construct(ObjectManagerInterface $objectManager, Translate $renderer)
    {
        parent::__construct();

        $this->objectManager = $objectManager;
        $this->renderer = $renderer;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('hmmh:wirecardexample:example');
        $this->setDescription('Example for wirecard/magento2-ee#225.');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Phrase::setRenderer($this->renderer);

        // Use ObjectManager since the tested logic is in the constructor and we need to set the renderer first,
        // so we can not get the validator through DI.
        $this->objectManager->create('Magento\Framework\View\Design\Theme\Validator');

        $output->writeln('This line will never be executed, because the previous line never returns');

        return null;
    }
}