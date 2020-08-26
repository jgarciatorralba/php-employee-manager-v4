<?php

    class AvatarsAPI {

        public function getAvatars()
        {
            $curl = curl_init();

            $API_key = "X-API-KEY: 0A2ED4BA-4E53420C-96665B70-60C6502A";
            $limit = 8;
            $emotion = 'happiness';

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://uifaces.co/api?limit=$limit&emotion[]=$emotion",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    $API_key
                ),
            ));
            
            $output = curl_exec($curl);

            curl_close($curl);

            return $output;
        }

    }

    $callToAPI = new AvatarsAPI();
    echo $callToAPI->getAvatars();
