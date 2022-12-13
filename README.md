# Učební Kartičky
Webová aplikace Učební Kartičky, která vznikla v rámci projektu na VUT FIT v roce 2022.
<dl>
	<dt>Autoři</dt>
	<dd>David Chocholatý
	    (<a href="mailto:xchoch09@stud.fit.vutbr.cz">xchoch09@stud.fit.vutbr.cz</a>)
	</dd>
	<dd>Tomáš Bártů <!-- Nahraďte skutečným jménem a e-mailem autora a popisem činnosti -->
	    (<a href="mailto:xbartu11@stud.fit.vutbr.cz">xbartu11@stud.fit.vutbr.cz</a>)
	</dd>
  <dd>Šimon Vacek <!-- Nahraďte skutečným jménem a e-mailem autora a popisem činnosti -->
	    (<a href="mailto:xvacek10@stud.fit.vutbr.cz">xvacek10@stud.fit.vutbr.cz</a>)
	</dd>
	<dt>URL aplikace</dt>
	<dd><a href="https://ucebnikarticky.jednoduse.cz/">https://ucebnikarticky.jednoduse.cz/</a></dd>
</dl>

<h2>Uživatelé systému pro testování</h2>
<p>Existující zástupci všech rolí uživatelů (pozn.: tito zástupci jsou již vytvořeni ve veřejné verzi na <a href="https://ucebnikarticky.jednoduse.cz/">https://ucebnikarticky.jednoduse.cz/</a>).</p>
<table>
<tbody><tr><th>Login</th><th>Heslo</th><th>Role</th></tr>
<tr><td>admin@example.com</td><td>admin</td><td>Administrátor</td></tr>
<tr><td>BBELM@example.com</td><td>Osciloskop123</td><td>Učitel</td></tr>
<tr><td>speedy@example.com</td><td>BigShock</td><td>Student</td></tr>
<tr><td><i>bez loginu</i></td><td><i>bez hesla</i></td><td>Nepřihlášený uživatel</td></tr>
</tbody></table>

<h2>Instalace</h2>

<p>Celý projekt si lze stáhnout z následujícího odkazu:</p>
<a href="https://github.com/davidchocholaty/ucebni-karticky/tree/2ba95bd2c88bbe3be16cdca895692f07416b9086">https://github.com/davidchocholaty/ucebni-karticky/tree/2ba95bd2c88bbe3be16cdca895692f07416b9086</a>

<h4>Požadavky</h4>

Pro spuštění projektu je zapotřebí splnit následující požadavky:
<ul>
    <li>
        PHP: ^7.3
    </li>
    <li>
        Laravel: ^8.75 (pozn.: bude nainstalováno automaticky při následující instalaci projektu, viz dále)
    </li>
    <li>
        Composer: otestováno na 2.4.2 - 2.4.4
    </li>
    <li>
        Databáze: MySQL (InnoDB)
    </li>
    <li>
        Požadavky na verze knihoven (viz soubor <i>composer.json</i>):
        <p>- pozn.: bude nainstalováno automaticky při následující instalaci projektu, viz dále</p>
        <ul>
            <li>
                Požadovány:
                <ul>
                    <li>
                        fruitcake/laravel-cors: ^2.0
                    </li>
                    <li>
                        guzzlehttp/guzzle: ^7.0.1
                    </li>
                    <li>
                        laravel/framework: ^8.75
                    </li>
                    <li>
                        laravel/sanctum: ^2.11
                    </li>
                    <li>
                        laravel/tinker: ^2.5
                    </li>
                    <li>
                        laravel/ui: ^3.4
                    </li>
                    <li>
                        ext-json: *
                    </li>
                </ul>
            </li>
            <li>
                Požadovány pro vývoj:
                <ul>
                    <li>
                        facade/ignition: ^2.5
                    </li>
                    <li>
                        fakerphp/faker: ^1.9.1
                    </li>
                    <li>
                        laravel/sail: ^1.0.1
                    </li>
                    <li>
                        mockery/mockery: ^1.4.4
                    </li>
                    <li>
                        nunomaduro/collision: ^5.10
                    </li>
                    <li>
                        phpunit/phpunit: ^9.5.10
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>

<p>Pro instalaci <i>PHP</i> například verze 7.4 na Ubuntu 20.04 lze doporučit postup dle následujícího odkazu:</p>
<a href="https://www.digitalocean.com/community/tutorials/how-to-install-php-7-4-and-set-up-a-local-development-environment-on-ubuntu-20-04">https://www.digitalocean.com/community/tutorials/how-to-install-php-7-4-and-set-up-a-local-development-environment-on-ubuntu-20-04</a>

<p>Pro instalaci <i>Composer</i> na Ubuntu 20.04 lze doporučit postup dle následujícího odkazu:</p>
<a href="https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart">https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart</a>

<h4>Postup instalace a spuštění</h4>
<p><u>Po nainstalování všech požadovaných utilit (<i>PHP</i> a <i>Composer</i>) postupujte dle následujících instrukcí:</u></p>

<ol>
    <li>
        <p>Nejprve je nutné si stáhnou celý projekt z výše uvedeného odkazu (<i>github</i>). Po stažení a případném rozbalení archivu se přesuňte do kořenové složky projektu příkazem:</p>
        <pre><i>$ cd ucebni-karticky/</i></pre>
        <p>Všechny další úkony provádějte výhradně ve zmíněné umístnění. Poté pro instalaci zadejte následující 2 příkazy:</p>
        <pre><i>$ composer update</i>&nbsp;
<i>$ composer install</i></pre>
    </li>
    <li>
        <p> Dále je nutné vytvořit soubor <i>.env</i> a jeho obsah vyplnit obsahem souboru <i>.env.example</i>. Zmíněný postup lze provést následujícím příkazem:</p>
        <pre><i>$ cp .env.example .env</i></pre>
    </li>
    <li>
        <p>Poté je třeba vytvořit vlastní MySQL databázi. Po jejím vytvoření je nutné její název, uživatele a jeho heslo zadat do souboru <i>.env</i> za následující parametry ve stejném pořadí:</p>
        &nbsp;
        <ul>
            <li>
                DB_DATABASE=<i>jméno databáze</i>
            </li>
            <li>
                DB_USERNAME=<i>jméno uživatele</i>
            </li>
            <li>
                DB_PASSWORD=<i>heslo uživatele</i>
            </li>
        </ul>
        &nbsp;
    </li>
    <li>
        <p>Jako další krok zadejte uvedený příkaz pro vygenerování klíče:</p>
        <pre><i>$ php artisan key:generate</i></pre>
    </li>
    <li>
        <p>Jako předposlední krok bude vytvořena struktura databáze a naplněna testovacími daty.
        Pro vygenerování uvedených uživatelů systému společně s náhodně vygenerovanými
        uživateli zadejte následují příkaz:</p>
        <pre><i>$ php artisan migrate:fresh --seed</i></pre>
        <p><i>Pozn.: pro vytvoření databáze bez naplnění testovacími daty zadejte příkaz:</i></p>
        <pre><i>$ php artisan migrate:fresh.</i></pre>
        <p>Poté je možná naplnit vytvořenou strukturu tabulek pomocí přiloženého SQL skriptu <i>input.sql</i>. Případně je možné totožný skript najít ve složce <i>/docs</i> ve staženém projektu.</p>
    </li>
    <li>
        <p>Po splnění všech požadavků je pak možné projekt spustit následujícím příkazem při umístění v kořenové složce projektu:</p>
        <pre><i>php artisan serve</i></pre>
        <p>Po zadání uvedeného příkazu pak lze na webovou stránku přistoupit na adrese uvedené ve výstupu terminálu:</p>
        &nbsp;
        <p>například: <i>127.0.0.1:8000</i></p>
        &nbsp;
        <p>Pro testování aplikace je opět možné využít výše zmíněné uživatele systému pro testování tak, jako je tomu v případě veřejné verze na <a href="https://ucebnikarticky.jednoduse.cz/">https://ucebnikarticky.jednoduse.cz/</a>.</p>
    </li>
    <hr />
    Pozn.: pro spuštění poskutnutých testů zadejte následující příkaz:
    <pre><i>php artisan test</i></pre>
</ol>

<style>
pre {
    background: #383838;
    color: #d3d3d3;
    page-break-inside: avoid;
    font-family: monospace;
    line-height: 1.6;
    margin-bottom: 1.6em;
    max-width: 100%;
    overflow: auto;
    padding: 1em 1.5em;
    display: block;
    word-wrap: break-word;
}
</style>
