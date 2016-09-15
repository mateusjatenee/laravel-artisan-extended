<?php

use Mateusjatenee\LaravelArtisanExtended\Commands\MakeTransformerCommand;
use Mockery as M;

class MakeTransformerCommmandTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->markTestSkipped('Gotta refactor this asap');

        $this->filesystem = M::mock(Illuminate\Filesystem\Filesystem::class);
        $this->input = M::mock(Symfony\Component\Console\Input\InputInterface::class);
    }

    public function tearDown()
    {
        M::close();
    }

    /** @test */
    public function it_guesses_the_model()
    {
        $command = new MakeTransformerCommand($this->filesystem);
        $this->assertEquals('App\User', $command->getModel('App/User'));
        $this->assertEquals('App\User', $command->getModel('App\User'));
    }
}
