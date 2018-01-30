<?php
namespace Trois\Social\Shell;

use Cake\Console\Shell;

/**
* Social shell command.
*/
class SocialShell extends Shell
{

  public $tasks = ['Trois/Social.Facebook','Trois/Social.Instagram','Trois/Social.Twitter'];

  public function getOptionParser()
  {
    $parser = parent::getOptionParser();
    $parser
    ->addSubcommand('facebook', [
        'help' => 'Execute The Facebook Task.',
        'parser' => $this->Facebook->getOptionParser(),
    ])
    ->addSubcommand('instagram', [
        'help' => 'Execute The Instagram Task.',
        'parser' => $this->Instagram->getOptionParser(),
    ])
    ->addSubcommand('twitter', [
        'help' => 'Execute The Twitter Task.',
        'parser' => $this->Twitter->getOptionParser(),
    ])
    ->addOption('save', [
        'short' => 's',
        'help' => __('Save the post')
    ])
    ->addOption('model', [
        'short' => 'm',
        'help' => __('Specify a model to save the posts with...'),
        'default' => 'Trois/Social.SocialPosts',
    ]);
    return $parser;
  }

  public function main()
  {
    $this->out($this->OptionParser->help());
  }
}
