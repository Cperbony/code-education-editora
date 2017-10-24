<h1> Desenvolvendo uma Editora Online com Laravel 5.3 </h1>
<h2>by Code Education</h2>
<h3>Curso Ministrado pelo <a href="https://about.me/carlosluiz">Prof. Luiz Carlos Diniz</a><h/3>
<hr/>
<h4>Fase 1 - Abrindo a Editora</h4>
<p>Nesta fase você deverá cria o ambiente da aplicação Laravel 5.3 mostrado no capítulo inicial, bem como o CRUD de categorias.</br>
Você deverá criar também um CRUD para os livros da loja virtual.</br></p>
<ul>
<b>O model livro deverá conter os seguintes campos:</b>
<li>title - string (obrigatório)</li>
<li>subtitle - string (obrigatório)</li>
<li>price - float (obrigatório)</li>
</ul>
<hr/>
<h4>Fase 2 - Form Request Validation</h4>
<p>Nesta fase você deverá criar um form request validation para categoria e livro.</br>
Crie também as regras de validação para os campos de cada modelo.</br></p>
<p>Agora você deverá criar uma relação entre livro e autor.</p>
<p>Todo livro cadastrado deverá ter o seu respectivo autor associado.
   A edição dos dados do livro só poderá ser feita pelo próprio autor, então, teremos que usar o form request validation para autorizar isto.</p>
<hr/>

<h4>Fase 3 - Organização da área administrativa</h4>
<p>Nesta fase você deverá aplicar o Bootstrapper nos CRUD de categorias e livros.</p></br>
<p>Além disto quando o usuário enviar dados via formulário e estes dados forem inválidos e logo em seguida o cadastro for realizado, o usuário deve ser direcionado para a página anterior (Lembrando que no momento isto não ocorre, porque se os dados forem inválidos, a URL armazenada será a da própria página).</p></br>
<hr/>

<h4>Fase 4 - Repositories e Criterias</h4>
<p>Nesta fase você deverá refatorar toda aplicação para trabalhar com repositories e criar buscas na listagem de livros e categorias.</p> 
<hr/>

<h4>Fase 5 - Exclusão lógica</h4>
<p>Criar o relacionamento entre livros e categorias.</p>
<p>Adicionar na busca de livros, a oportunidade de buscar livros pelo nome de um categoria por like.</p>
<p>Implementar a exclusão lógica para livros e categorias.</p>
<p>Criar a lixeira de livros.</p>
<p>Estilizar as categorias excluídas quando mostradas na área de livros.</p>
<hr/>


<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
