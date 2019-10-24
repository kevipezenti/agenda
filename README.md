# agenda
API REST, em PHP com o framework Lumen

# ROTAS DA API

# HTTP Request

POST agenda/
PUT agenda/
GET agenda/{data}

# ROTA POST agenda/

    Responsável por inserir os agendamentos, para isso, é necessário informa um objeto JSON
    com os seguintes atributos:

        [
        "id_sala": "",
        "email": "",
        "data_inicio": "",
        "data_fim": "",
        "descricao": ""
        ]

# JSON id_sala

    Atributo obrigatório para essa rota, do tipo inteiro.

# JSON email
