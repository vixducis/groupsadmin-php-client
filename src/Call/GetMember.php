<?php declare(strict_types=1);

namespace Wouterh\GroepsadminClient\Call;

use Wouterh\GroepsadminClient\Model\Member;

class getMember extends CallBase
{
    private const API_TRANSLATION_FUNCTIONS = [
        'id' => 'setId',
        'email' => 'setMail',
        'vgagegevens' => [
            'voornaam' => 'setFirstName',
            'achternaam' => 'setLastName',
            'geboortedatum' => 'setBirthDate'
        ],
        'verbondsgegevens' => [
            'lidnummer' => 'setMemberNumber'
        ],
        'persoonsgegevens' => [
            'gsm' =>  'setMobilePhone'
        ]
    ];

    /**
     * Fetches a member with it's groepsadmin ID.
     * @param string $id
     * @return Member
     */
    public function perform(string $id): Member
    {
        $content = json_decode($this->performCall("/lid/$id")->getBody()->getContents(), true);
        return Member::fromApi($content, self::API_TRANSLATION_FUNCTIONS);
    }
}