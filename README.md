# CRM
Projeto desenvolvido para avaliação da disciplina de Startup Model.

## Desenvolvedor
Milton Fernando Prado Filho

## Objetivo
Efetuar o controle e gestão de captação de Leads (contatos captados através de alguma ação/evento/campanha comercial), possibilitando a prospecção e movimentação do contato através de um funil de vendas, com a finalidade de conversão de contatos captados em clientes ativos. Gerando relatórios de clientes ativos e leads perdidos. Possibilitando um retrabalho com leads perdidos buscando uma conversão ou até manutenção de clientes ativos na base de cadastros.
O sistema será web, desenvolvido em java script com aplicação, html, php e css. Com banco de dados MYSQL.

## MCU
De acordo com os requisitos funcionais levantados com o stakeholder, foi desenvolvido esse modelo de caso de uso, com a seguinte lógica: o usuário tem a necessidade de ter um sistema que seja capaz de controlar novos cadastros de possíveis clientes e fazer marcações que siga um fluxo de vendas.
Como podemos observar o usuário inicia o processo, cadastrando um novo contato que geralmente direciona a primeira etapa do funil de vendas (porém também  tem opção de salvar o cadastro de um novo contato em outras etapas de venda), assim os cadastros irão ficar dispostos em fila de acordo com o estágio. Então o usuário vai fazendo a movimentação do card do contato pelo fluxo do funil de acordo com a evolução das negociações de cada contato. A opção de editar o contato é possível incluir anotações (como por exemplo, de qual ação ou evento que foi gerado esse lead), criar tarefas específicas a ser executada em um determinado período e incluir anexos como arquivos de propostas, projetos e documentação. Caso o usuário identifique que o contato não possui interesse em produtos ou serviços da empresa, é possível excluir o contato a qualquer momento.
Ao final do fluxo do funil do CRM o usuário pode concluir o processo com a tag de Ativo ou Perdido. Desta forma o card do contato sai do funil e é inserido à lista específica, gerando o Relatório de Clientes Ativos ou Contatos Perdidos, além de possibilitar futuras interações com cliente, buscando uma renovação de contrato, oferecer novos produtos ou tentar uma reversão de contatos perdidos

