
export const groups = [
    {id: 'config', name: 'Configurações', description: 'Configurações gerais', icon: 'conf'},
    {id: 'regs', name: 'Cadastros', description: 'Cadastros', icon: 'regs'}
]

export default [
    {id: 'users', name: 'Usuários', description: 'Cadastro de usuários', 
     group: 'config', route: '#users'},

    {id: 'salesmen', name: 'Vendedores', description: 'Cadastro de vendedores', 
     group: 'regs', route: '#salesmen'},

    {id: 'products', name: 'Produtos', description: 'Cadastro de produtos', 
     group: 'regs', route: '#products'},

    {id: 'sales', name: 'Vendas', description: 'Cadastro de vendas', 
     group: 'regs', route: '#sales'}
]