<?php

namespace FourIMobile\FourIArtisanCommands\Console\Device\Authentication\Routes;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateDarude extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = '4i:darude';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Darude (da Route - Haha get it?) Sandstorm';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Routes';


    public function handle()
    {
        file_put_contents(
            base_path('routes/' . 'api.php'),
            '
// https://www.youtube.com/watch?v=y6120QOlsfU            
// Duuuuuuuuuuuuuuuuuuuuuuun
// Dun dun dun dun dun dun dun dun dun dun dun dundun dun dundundun dun dun dun dun dun dun dundun dundun
// BOOM
// Dundun dundun dundun
// BEEP
// Dun dun dun dun dun
// Dun dun
// BEEP BEEP BEEP BEEP
// BEEEP BEEP BEEP BEEP
// BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BOOM
// Daddaddadadsadadadadadadadadadaddadadadadadaddadadaddadadadadadadadadadadadaddadddadaddadadadd dadadadaddaddada
// D
// Dadadddaddadaddadadadddadadada
// Nyu nyu nyu nyu nyu nnyu nyu nyu nyu nyu nyu nyu nyu nyu nyu nyu
// Doo doo doo doo doo doo doo doo
// Nnn nn nn nn nn nn n nn nnn nn nn nnn nnn nnnnnnnn
// Dddddddd ddadadadadaddadadadadadaadadadadadad
// BOOM
// Nyu nyu nyu nyu nyu nyu
// BOOM
// BOOM BOOM BOOM BOOM
// BOOM
// Nyunyunyu nyu nyu nyu nyu nyu nyu nyu nyu nyu nyu
// BOOM BOOM
// BEEP BEEP
// BEEP BEEP BEEP
// Dadadadadada
// Ddadad
// BOOM BOOM
// BBEP BEEP
// BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP BEEP
// BOOM
// (Unintelligible)
// Ddudndundun dun dun dun dun dun dun dun dun dun dun dun dun dun dun dund
// Dododododododododododododododododododododododododododododoodo
// DRUM DRUM DRUM
// Ddodododododoododododododododoodododododododo
// Chi chichi chi chi chih
// BOOOM
// Chcihcihfkdhfdisjfkla
// Dodododododododododododododododododododododododododododododododododoo
// SCHEW
// Dododododododoodododododododododododododo
// Dadadadddudndundundudnudndundundunddunfudnundudnudnudndund
// BOOM
// FADE
            ',
            FILE_APPEND
        );
    }

}
