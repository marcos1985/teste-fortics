<div class="container">
    <h4>Seja bem-vindo ao Refris</h4>
    <br>

    <h4>Documentação básica</h4>
    <hr>

    <h5># Download e setup (sem docker)</h5>
    <p>O projeto foi criado com o Laravel 5.8 por meio do composer, para rodar é necessário ter todos os requisitos pedidos pelo Laravel 5.8.</p>
    <p>Ao realizar o download deve-se baixar as dependencias com o comando: composer install, na pasta do projeto.</p>
    <p>Será necessário também criar o arquivo .env para se fazer a configuração do acesso ao bando de dados.</p>
    <p>As tabelas são criadas via migração, ferramenta fornecida pelo Laravel, com o sequinte comando dentro da pasta do projeto: php artisan migrate.</p>

    <br>
    <h5># Migrações</h5>
    <p>
        Foi escolhido o banco de dados mysql para o projeto. As tabelas criadas foram:
        <ul>
            <li>tb_tipo_referigerante</li>
            <li>tb_litragem_referigerante</li>
            <li>tb_refrigerante</li>
        </ul>

        Para cada tabela existe uma migração na pasta "teste-fortics/database/migrations".
    </p>

    <p>
        A regra de unicidade para refrigerantes se dá com os campos nome, id_tipo_refrigerante e id_litragem.
    </p>

    <br>

    <h5># Caracteristas </h5>

    <p>
        Foram criados três menus:
        <ul>
            <li>Refrigerantes</li>
            <li>Tipo Refrigerante</li>
            <li>Litragem</li>
        </ul>
    </p>

    <p>
        Escolhi criar o CRUD para tipo de refrigerente e litragem para deixar a aplicação mais genérica possível.
        Para cadastrar um novo refrigerante, será necessário primeiro o cadastro do tipo de refrigerante e litargem.
    </p>

    <p>
        Foram usadas as seguintes bibliotecas JavaScrit:
        <ul>
            <li>Jquery (<a href="https://jquery.com">https://jquery.com</a>) </li>
            <li>Bootstrap 4 (<a href="https://getbootstrap.com.br/">https://getbootstrap.com.br/</a>)</li>
            <li>Jquery loading (<a href="https://carlosbonetti.github.io/jquery-loading/">https://carlosbonetti.github.io/jquery-loading/</a>)</li>
            <li>Jquery Mask (<a href="https://igorescobar.github.io/jQuery-Mask-Plugin/">https://igorescobar.github.io/jQuery-Mask-Plugin/</a>)</li>
        </ul>
    </p>

    <p>
        Foram usados os seguintes frameworks css:
        <ul>
            <li>Bootstrap 4 (<a href="https://getbootstrap.com.br/">https://getbootstrap.com.br/</a>)</li>
            <li>Tema Yeti (<a href="https://bootswatch.com/yeti/">https://bootswatch.com/yeti/</a>)</li>
        </ul>
    </p>


    <br>
    <br>
</div>
