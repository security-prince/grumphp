<?php

namespace spec\GrumPHP\Formatter;

use GrumPHP\Formatter\RawProcessFormatter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Process\Process;

/**
 * @mixin RawProcessFormatter
 */
class RawProcessFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GrumPHP\Formatter\RawProcessFormatter');
    }

    function it_is_a_process_formatter()
    {
        $this->shouldHaveType('GrumPHP\Formatter\ProcessFormatterInterface');
    }

    function it_displays_the_full_process_output(Process $process)
    {
        $process->getOutput()->willReturn('stdout');
        $process->getErrorOutput()->willReturn('stderr');
        $this->format($process)->shouldReturn('stdout' . PHP_EOL . 'stderr');
    }

    function it_displays_stdout_only(Process $process)
    {
        $process->getOutput()->willReturn('stdout');
        $process->getErrorOutput()->willReturn('');
        $this->format($process)->shouldReturn('stdout');
    }

    function it_displays_stderr_only(Process $process)
    {
        $process->getOutput()->willReturn('');
        $process->getErrorOutput()->willReturn('stderr');
        $this->format($process)->shouldReturn('stderr');
    }
}
