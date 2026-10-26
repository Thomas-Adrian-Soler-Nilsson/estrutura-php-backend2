# estrutura-php-backend

Aplicação PHP com PDO e MySQL/MariaDB para cadastro, consulta, edição e pesquisa de categorias, clientes e fornecedores.

## Integrantes da dupla

- Integrante 1: **Marcos Vinícius**
- Integrante 2: **Thomas Adrian Soler Nilsson**

## Requisitos

- PHP 8.0+ com PDO MySQL habilitado
- MySQL ou MariaDB
- Apache (por exemplo, XAMPP)

## Instalação e execução

1. Clone o repositório para a pasta `htdocs` do XAMPP.
2. Importe `bd_backend.sql` no phpMyAdmin. O banco utilizado é `bd_backend`.
3. Confira host, usuário, senha e banco em `model/Conn.php`.
4. Inicie Apache e MySQL e abra `http://localhost/estrutura-php-backend2/view/`.
5. Para incluir registros de demonstração, execute `database/dados-demo.sql` depois de importar a estrutura.

## Pesquisas

- Cliente: pesquise por parte ou pelo nome completo em `?p=pesquisar/cliente`.
- Fornecedor: pesquise por parte ou pela razão social completa em `?p=pesquisar/fornecedor`.
- As consultas usam `LIKE` e parâmetros PDO preparados. Caracteres curinga digitados são tratados literalmente; resultados são escapados antes de exibir no HTML.
- Os métodos utilizados estão descritos em [`metodos-pesquisa.txt`](metodos-pesquisa.txt).

## Estrutura

- `model/`: entidades e conexão PDO
- `dao/`: consultas SQL e persistência
- `controller/`: coordenação entre formulários e DAOs
- `view/`: páginas e rotas
- `database/dados-demo.sql`: registros de exemplo para a demonstração

## Demonstração em vídeo

[Assistir à demonstração da pesquisa de clientes e fornecedores](assets/demo-pesquisa.mp4)
