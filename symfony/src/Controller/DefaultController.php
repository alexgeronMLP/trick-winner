<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{    
    /**
     * @Route("/run", name="run_game" ,methods={"POST"})
     */
    public function runGameAction(Request $request): Response
    {
        $data = $request->getContent();
        $object = json_decode($data, true);
        $cards = [
            1 || 'Ace' => 14,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            10 => 10,
            'Jack' => 11,
            'Queen' => 12,
            'King' => 13,
        ];
        
        $trump = $object['TRUMP'] ?? '';
        $tricks = $object['TRICKS'];
       
        if (count($tricks) > 13) {
            throw new Exception('You can\'t have more than 13 tricks.');
        }

        $winners = [];

        foreach ($tricks as $trick) {
            $winner = null;
            $trumpWinner = null;

            if (count($trick) > 4) {
                throw new Exception('You can\'t have more than 4 players.');
            }

            foreach ($trick as $player) {
                if (!isset($winner['value']) || $cards[$winner['value']] < $cards[$player['value']]) {
                    $winner = $player;
                }
                if ($trump && $trump === $player['color'] && (!isset($trumpWinner['value']) || $cards[$trumpWinner['value']] < $cards[$player['value']])) {
                    $trumpWinner = $player;
                }
            }
            $winners[] = $trumpWinner ?? $winner;
        }
        
        return new Response(json_encode($winners, JSON_HEX_QUOT));
    }
}
