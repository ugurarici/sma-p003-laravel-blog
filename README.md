<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About the Project
This Laravel Blog project is prepared for educational purposes with regard to full-stack web development courses in Siliconmade Academy, namely SMA-P003. In this project, a user can register to the application; login with his/her credentials; read and scan through various other posts and different categories; create, edit or delete his/her own articles; and follow different categories and get updated considering the published articles in his/her list of following categories.

## Features
- [Laravel UI](https://github.com/laravel/ui) starter kit with Auth scaffolding.
- [Blade](https://laravel.com/docs/8.x/blade) view templating engine and [Bootstrap](https://getbootstrap.com/) CSS toolkit.
- [Redis](https://laravel.com/docs/8.x/redis) for queed tasks (namely e-mail notifications on newly created articles)
  - [Horizon](https://laravel.com/docs/8.x/horizon) dashboard and code-driven configuration for Redis queues.
- [Mailhog](https://github.com/mailhog/MailHog) for e-mail testing tool for development purposes.


## Installing Project
- Clone the git repository: `git clone https://github.com/ugurarici/sma-p003-laravel-blog.git`
    - If you have [SSH connection established in your GitHub profile](https://docs.github.com/en/enterprise-cloud@latest/authentication/connecting-to-github-with-ssh) you can simply clone the repository through SSH: `git clone git@github.com:ugurarici/sma-p003-laravel-blog.git`
- Install all dependencies of the project: `composer install`
- Modify the `.env` file and configure your database settings.
  - Do not forget to configure your [Redis](https://laravel.com/docs/8.x/redis) and [Mailhog](https://github.com/mailhog/MailHog) settings as stated in the document.
- Attach a fresh application key to the project with `php artisan key:generate`
- Run the migrations `php artisan migrate`
- Start horizon with `php artisan horizon` and seed the database with `php artisan db:seed`
