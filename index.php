<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get EnableX Api</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        .btn {
        padding: 12px 50px;
        margin-bottom:10px;
        color: #fff;
        }
        .red {
        background-color: red !important;
        }
        .green {
        background-color: green !important;
        }
    </style>
</head>

<body>
    <?php

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.enablex.io/video/v2/rooms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'Authorization: Basic NjJmZmQ0MzJhMmU0M2M1ZjQxNDAzNDA2OmFkeW11eXlMYXVlOXVUZU1hSHlWdTlhcHVndVVhenUzdUd1Vw=='
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resArr = json_decode($response);
        echo '<div class="container p-4 text-center"><div class="row">';
        $names = array('Room 1','Room 2','Room 3','Room 4','Room 5','Room 6','Room 7','Room 8','Room 9','Room 10','Entertainment Room');
        $url = array(
            'https://www.crowdcover.app/1-moderator-room',
            'https://www.crowdcover.app/2-moderator-room',
            'https://www.crowdcover.app/rooms-list#',
            'https://www.crowdcover.app/4-moderator-room',
            'https://www.crowdcover.app/5-moderator-room',
            'https://www.crowdcover.app/6-moderator-room',
            'https://www.crowdcover.app/7-moderator-room',
            'https://www.crowdcover.app/8-moderator-room',
            'https://www.crowdcover.app/9-moderator-room',
            'https://www.crowdcover.app/bovada-nfl-moderator-room',
            'https://www.crowdcover.app/entertainment-room-leader'
        );
        $count = 0;
        $url_count = 0;
        foreach ($resArr->rooms as $rooms) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.enablex.io/video/v2/rooms/'.$rooms->room_id.'/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'Authorization: Basic NjJmZmQ0MzJhMmU0M2M1ZjQxNDAzNDA2OmFkeW11eXlMYXVlOXVUZU1hSHlWdTlhcHVndVVhenUzdUd1Vw=='
            ),
            ));

            $user_response = curl_exec($curl);

            curl_close($curl);
            $user_resArr = json_decode($user_response);
            if ($user_resArr->total > 0) { ?>
            <div class="col-md-2"><div class="d-grid gap-2">
                <button type="button" data-count="<?php echo $user_resArr->total;?>" class="btn red room-btn disabled" onclick='window.open("<?php echo $url[$url_count++];?>", "_blank");'>
                    <?php echo $names[$count++];?>
                </button>
            </div></div>
            <?php } else { ?>
            <div class="col-md-2"><div class="d-grid gap-2">
                <button type="button" data-count="<?php echo $user_resArr->total;?>" class="btn green room-btn" onclick='window.open("<?php echo $url[$url_count++];?>", "_blank");'>
                    <?php echo $names[$count++];?>
                </button>
            </div></div>
            <?php }
            

        }
        echo "</div></div>";

    ?>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        
	jQuery( ".room-btn" ).click(function() {
	//   let url = jQuery( this ).data("url");
      let count = jQuery( this ).data("count");
      var windowReference = window.open();
      if (count > 0) {
        jQuery( this ).addClass( "red" );
        jQuery( this ).removeClass( "green" );
      }else{
        setTimeout(function() {
        myService.getUrl().then(function(url) {
            windowReference.location = url;
        }); 
		// if (url) {
        //     window.open(url, '_blank');   
        // }
        //window.cordova.InAppBrowser.open(url, '_blank');
		}, 1000);
      }
	});
    setTimeout(function(){
    window.location.reload(10);
    }, 6000);
    </script>
</body>
</html>