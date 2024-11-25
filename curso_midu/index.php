<?php
    const API_URL = "https://whenisthenextmcufilm.com/api";
    # Inicializar una nueva sesion de cURL; ch = cURL handle
    $ch = curl_init(API_URL);
    // Indicar que queremos recibir el resultado de la peticion y no mostrarla en pantalla
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    /* Ejecutamos la peticion
    y guardamos el resultado*/
    $result = curl_exec($ch);
    $data = json_decode($result, true); // que lo guarde como array asociativo
    curl_close($ch);

    
?>



<main>
    
    <section>
        <img src="<?php echo $data['poster_url']; ?>" width='200'  alt="Poster de <?= $data["title"];?>" style='border-radius: 10px'>
    </section>
    <hgroup>
    <h3> <?= "\"".$data['title']."\" ". "la proxima película de Marvel se estrena en: ". $data['days_until']." días"?>    </h3>
    <p> Fecha de estreno: <?= $data["release_date"] ; ?></p>
    <p> La siguiente película es: <?= " ". $data["following_production"]["title"];?>  </p>
    </hgroup>

    <pre  data-theme="dark">
       <?php var_dump($data); ?>
    </pre>
    
</main>

<head>
    <title>La proxima peli de Marvel (APIs en PHP)</title>
    <!-- Centered viewport -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
>
</head>



<style>
    :root{
        color-scheme: dark;
    }
    body{
        display: grid;
        place-content: center;
    }
    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

</style> 