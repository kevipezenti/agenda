# agenda
**API REST**, em **PHP** com o framework ***Lumen***, com o objetivo de simular agendamentos de sala, utilizando **SGDB MySQL**.
Com suas **EndPoits** é possível *agendar*, *cancelar* e *consultar* os agendamentos por dia.


## ROTAS DA API

### HTTP Request

* **POST** agenda/
* **PUT** agenda/
* **GET** agenda/{data}

#### ROTA POST agenda/

Responsável por inserir os agendamentos, para isso, é necessário informa um objeto **JSON**
com os seguintes atributos:

    ["id_sala": "",
    "email": "",
    "data_inicio": "",
    "data_fim": "",
    "descricao": ""]

Caso não ocorra nenhuma divergência, será retornado um objeto **JSON**, contendo todo conteúdo
inserindo, incluindo o id de registro, como no exemplo:

    Dados de envio:

       ["id_sala": "3",
        "email": "teste@teste.com.br",
        "data_inicio": "2015-10-14 10:00:00",
        "data_fim": "2015-10-14 11:30:00",
        "descricao": "Apenas teste de cadastro de agenda de reunião"]

    Dados de Retorno:

       ["id_sala": "3",
        "email": "teste@teste.com.br",
        "data_inicio": 1444816800,
        "data_fim": 1444822200,
        "descricao": "Apenas teste de cadastro de agenda de reunião",
        "id": 7]

Por outro lado, caso ocorra alguma divergência, será retornado um objeto **JSON**, contendo
o status e um retorno da evetualidade, exemplo:

    {"status": "false",
    "response": "Sala não disponível para data e horário definido."}

#### Descrição dos Atributos

* **JSON -> id_sala**

    Atributo obrigatório para essa rota, tipo inteiro.

* **JSON -> email**

    Atributo obrigatório, tamanho máximo 50.
    
* **JSON -> data_inicio**

    Atributo obrigatório, formato aceito Y-m-d H:i:s, exemplo:
    > 2015-10-14 10:00:00

* **JSON -> data_fim**

    Atributo obrigatório, formato aceito Y-m-d H:i:s, exemplo:
    > 2015-10-14 10:00:00
    
* **JSON -> descricao**

    Atributo obrigatório, tipo string.
    
#### ROTA PUT agenda/

Encarregada de cancelar os agendamentos, para isso deve se informada o *id_sala*, *data_inicio* do agendamento e *email*
do solicitante, com no exemplo:

    ["id_sala": "3",
    "email": "teste@teste.com.br",
    "data_inicio": "2015-10-14 10:00:00"]

Caso ocorra tudo normalmente, será retornado TRUE, senão um objeto **JSON** é retornado, no seguinte formato:

    ["status": "false",
    "response": "Nao foi encontrado agenda para cancelar."]
    
#### Descrição dos Atributos

Segue ao exemplo da **"ROTA POST agenda/"** citada logo acima.


#### ROTA GET agenda/{data}

Realiza a busca dos agendamentos por data informada na passagem da rota, trazendo todos os agendamento na data informada em um formato **JSON**, conforme exemplo:

    [{
        "id": 1,
        "id_sala": 1,
        "email": "teste@teste.com.br",
        "data_inicio": 1571133600,
        "data_fim": 1571135400,
        "status": 1,
        "descricao": "somente teste de agendamento de reunião"
    },
    {
        "id": 6,
        "id_sala": 1,
        "email": "teste@teste.com.br",
        "data_inicio": 1571135400,
        "data_fim": 1571139000,
        "status": 1,
        "descricao": "somente teste de agendamento de reunião"
    }]

Caso a data informada não seja válida, será retornado um conjunto vazio.

#### Descrição dos Atributos

* **agenda/{data}**

    Atributo obrigatório, seguindo o seguinte formato Y-m-d, por exemplo:
     > 2015-10-14
     
