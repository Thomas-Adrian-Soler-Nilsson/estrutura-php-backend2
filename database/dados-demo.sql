USE bd_backend;

INSERT INTO cliente (nome, email, telefone)
SELECT 'João Silva', 'joao@email.com', '(11) 90000-0001'
WHERE NOT EXISTS (SELECT 1 FROM cliente WHERE email = 'joao@email.com');

INSERT INTO cliente (nome, email, telefone)
SELECT 'João Santos', 'joao.santos@email.com', '(11) 90000-0002'
WHERE NOT EXISTS (SELECT 1 FROM cliente WHERE email = 'joao.santos@email.com');

INSERT INTO cliente (nome, email, telefone)
SELECT 'Maria e João', 'maria@email.com', '(11) 90000-0003'
WHERE NOT EXISTS (SELECT 1 FROM cliente WHERE email = 'maria@email.com');

INSERT INTO fornecedor (razao_social, email, telefone)
SELECT 'Tech Solutions Ltda', 'contato@tech.com', '(11) 4000-0001'
WHERE NOT EXISTS (SELECT 1 FROM fornecedor WHERE email = 'contato@tech.com');

INSERT INTO fornecedor (razao_social, email, telefone)
SELECT 'Tech Informática', 'contato@techinfo.com', '(11) 4000-0002'
WHERE NOT EXISTS (SELECT 1 FROM fornecedor WHERE email = 'contato@techinfo.com');
