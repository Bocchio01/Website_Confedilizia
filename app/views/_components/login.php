<html>

<?php echo render('./template/site/head.php', array('title' => 'Pagina di login'), 1); ?>

<body>
    <div>

        <?php echo render('./template/site/header.php', array('title' => 'Pagina di login', 'subtitle' => "accedi all'area riservata")); ?>

        <main>

            <p>
                Inserisci la password di accesso all'area riservata
            </p>

            <form action="<?php echo $fromURL ?>" method="post">
                <label for="api_key">Inserisci la password:</label>
                <input name="api_key" id="api_key" type="text" required="required">
                <input name="submitLogin" id="submit" type="submit" value="Login">
            </form>

        </main>

        <?php echo render('./template/site/footer.php', array()); ?>

    </div>
</body>

</html>