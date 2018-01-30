<?php
namespace Trois\Social\Shell;

use Cake\Console\Shell;

/**
* Social shell command.
*/
class SocialShell extends Shell
{

  public $tasks = ['Trois/Social.Facebook'];

  public function getOptionParser()
  {
    $parser = parent::getOptionParser();
    $parser->addSubcommand('facebook', [
        'help' => 'Execute The Facebook Task.',
        'parser' => $this->Facebook->getOptionParser(),
    ]);
    return $parser;
  }

  public function main()
  {
    $this->out($this->OptionParser->help());
  }
}
