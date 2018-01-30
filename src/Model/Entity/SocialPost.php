<?php
namespace Trois\Social\Model\Entity;

use Cake\ORM\Entity;

/**
 * SocialPost Entity
 *
 * @property string $id
 * @property string $provider
 * @property \Cake\I18n\FrozenTime $date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $display
 * @property string $link
 * @property string $message
 * @property string $author
 * @property string $image
 */
class SocialPost extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'provider' => true,
        'date' => true,
        'created' => true,
        'modified' => true,
        'display' => true,
        'link' => true,
        'message' => true,
        'author' => true,
        'image' => true
    ];
}
