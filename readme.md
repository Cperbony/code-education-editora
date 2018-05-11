# Desenvolvendo uma Editora Online com Laravel 5.3
## by Code Education
#### Curso Ministrado pelo <a href="https://about.me/carlosluiz">Prof. Luiz Carlos Diniz</a><h/3>
<hr/>

### Fase 1 - Abrindo a Editora
<p>Nesta fase você deverá cria o ambiente da aplicação Laravel 5.3 mostrado no capítulo inicial, bem como o CRUD de categorias.</br>
Você deverá criar também um CRUD para os livros da loja virtual.</br></p>
<ul>
<b>O model livro deverá conter os seguintes campos:</b>
<li>title - string (obrigatório)</li>
<li>subtitle - string (obrigatório)</li>
<li>price - float (obrigatório)</li>
</ul>
<hr/>

### Fase 2 - Form Request Validation
<p>Nesta fase você deverá criar um form request validation para categoria e livro.</br>
Crie também as regras de validação para os campos de cada modelo.</br></p>
<p>Agora você deverá criar uma relação entre livro e autor.</p>
<p>Todo livro cadastrado deverá ter o seu respectivo autor associado.
   A edição dos dados do livro só poderá ser feita pelo próprio autor, então, teremos que usar o form request validation para autorizar isto.</p>
<hr/>

### Fase 3 - Organização da área administrativa
<p>Nesta fase você deverá aplicar o Bootstrapper nos CRUD de categorias e livros.</p></br>
<p>Além disto quando o usuário enviar dados via formulário e estes dados forem inválidos e logo em seguida o cadastro for realizado, o usuário deve ser direcionado para a página anterior (Lembrando que no momento isto não ocorre, porque se os dados forem inválidos, a URL armazenada será a da própria página).</p></br>
<hr/>

### Fase 4 - Repositories e Criterias
<p>Nesta fase você deverá refatorar toda aplicação para trabalhar com repositories e criar buscas na listagem de livros e categorias.</p> 
<hr/>

### Fase 5 - Exclusão lógica
Criar o relacionamento entre livros e categorias.<br>
Adicionar na busca de livros, a oportunidade de buscar livros pelo nome de um categoria por like.<br>
<p>Implementar a exclusão lógica para livros e categorias.<br>
Criar a lixeira de livros.
Estilizar as categorias excluídas quando mostradas na área de livros.
<hr>

### Fase 6 - Criando primeiro módulo
Nesta fase, você deverá criar o módulo de administração de livros e categorias como demonstrado no capítulo.<br>
<p>Obs.: Nas views de criação e edição, precisamos acrescentar o namespace de view para fazer o include do formulário.</p>
<hr/>

### Fase 7 - Começando com Autorização
Criação da autenticação de administração de usuários.<br>
CRUD de Usuários.<br>
Integração com Laravel User Verification
Envio de Email de Usuários.<br>
Controle de Usuários Não Validados.<br>
Nesta fase você deve implementar a autorização da área administrativa mostrada no capítulo e também toda parte de ACL. Além disto implemente um CRUD de Roles (só admins podem cadastrar roles).<br>
O nome da Role deve ser único no banco de dados, então é necessário validar se o nome não existe e não deve ser permitido excluir a Role Admin padrão.

### Fase 8 - Terminando Autorização
Nesta fase você deverá fazer as seguintes tarefas
* Terminar a autorização proposta no capítulo usando annotations.
* Permitir o salvamento da desmarcação das permissões associadas aos pápeis de usuários
* Criar a autorização para o módulo de CodeEduBook, ou seja, criar permissões nos controllers/actions do módulo.
* Criar uma migração no módulo de CodeEduBook para adicionar uma role "Autor" no banco de dados.
Desafio (opcional): Criar um serviço com facade para montar o menu de usuário de acordo com as permissões dele.

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
