<?php

    class AvatarsAPI {

        public function getAvatars(
            int $limit,
            string $gender,
            int $fromAge,
            int $toAge,
            string $hairColor,
            string $emotion
        )
        {
            // 1. Initialize
            $ch = curl_init();

            // 2. Set the options

            // Adding header to the request with the API key
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Header-Key: Header-Value', 'X-API-KEY: 653FC76C-16B34BA2-828A310D-EC6E3CF7'
            )
            );

            // URL to send the request to
            $baseURL = 'https://uifaces.co/api';
            $paramLimit = 'limit=' . $limit;
            $paramGender = 'gender[]=' . $gender;
            $paramFromAge = 'from_age=' . $fromAge;
            $paramToAge = 'to_age=' . $toAge;
            $paramHairColor = 'hairColor[]=' . $hairColor;
            $paramEmotion = 'emotion[]=' . $emotion;

            $url = $baseURL . '?' . $paramFromAge;
            if ($limit != 10){
            $url = $url . '&' . $paramLimit;
            }
            if ($gender != ""){
            $url = $url . '&' . $paramGender;
            }
            if ($toAge != 0){
            $url = $url . '&' . $paramToAge;
            }
            if ($hairColor != ""){
            $url = $url . '&' . $paramHairColor;
            }
            if ($emotion != ""){
            $url = $url . '&' . $paramEmotion;
            }

            curl_setopt($ch, CURLOPT_URL, $url);

            // Return instead of outputting directly
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Whether to include the header in the output. Set to false
            curl_setopt($ch, CURLOPT_HEADER, 0);

            // 3. Execute the request and fetch the response.
            $output = curl_exec($ch);

            // 4. Close and free up the curl handle
            curl_close($ch);

            // 5. Display the raw output. Check for errors
            if ($output === FALSE){
            $error = 'cURL Error: ' . curl_error($ch);
            return $error;
            } else {
            return $output;
            }
        }

    }

    $gender = $_POST["gender"];
    $parsedGender = "";
    if ($gender == "man"){
        $parsedGender = "male";
    } elseif ($gender == "woman") {
        $parsedGender = "female";
    }

    $avatarsAPI = new AvatarsAPI();
    echo $avatarsAPI->getAvatars(10, $parsedGender, 18, 0, "", "happiness");
