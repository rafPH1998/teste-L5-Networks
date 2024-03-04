### Para rodar o projeto

Clone o repositório:

```sh
git clone https://github.com/rafPH1998/teste-L5-Networks.git
```

Entre no projeto:

```sh
cd teste-L5-Networks
```

Abra no seu editor

```sh
code .
```

Após clonar o projeto, rode o comando para subir o banco de dados. OBS: caso tiver o docker instalado na máquina

```sh
docker compose up -d
```

Na pasta dump, segue o arquivo do dump do banco de dados

```sh
dump/teste_l5.sql
```

Informações para acesso ao banco de dados

```sh
porta: 3306
host: 127.0.0.1
user: root
senha: root
db_name: 'teste_l5';
```

O projeto está rodando na porta 3306: "http://localhost:3006"

----------------------------------------------------------------------------------------------------------------------------------------------------------------

### O que foi feito no projeto:

- Correção de exibição no painel, alterando a cor do card e do icone para ramais offiline
- Correção de exibição no painel para ramais que estão em pausa, alterando a cor do icone para identificação
- Exibição do nome dos agentes que estão no grupo de callcenter SUPORTE

### Melhorias aplicada:

- Transformação do arquivo lib\ramais.php para uma classe para melhor organização no código
- Criação de base de dados para armazenar dados do ip, ramal, nome, status do ramal e se está online na tabela
- Atualizando a tela a cada 10 segundos para sempre manter as informações atualizas na base de dados 

