ZfcUserProfilePicture
=======

Introduction
------------
This module adds profile picture upload functionality to ZfcUser.

Installation
------------
#### With composer

1. Add this project composer.json:

    ```json
    "require": {
        "eye4web/zfc-user-profile-picture": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    $ php composer.phar update
    ```

3. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Eye4web\ZfcUser\ProfilePicture'
        ),
        // ...
    );
    ```

4. Copy `config/eye4web.zfcuser.profilepicture.global.php.dist` to `config/autoload/eye4web.zfcuser.profilepicture.global.php` and configure to your needs.

5. Make your User Entity implement `Eye4web\ZfcUser\ProfilePicture\Entity\ProfilePictureInterface`
