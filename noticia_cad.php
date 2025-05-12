<?php 
/*
* Código de exemplo da utilização de CSV como persistencia
* Página reponsável pelo formulário de cadastro da entidade Pessoa
* @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
* @version 0.1
*
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">

        <form action="noticia_Acao.php" method="post">
            <fieldset>
                <legend>Cadastro de Pessoas</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="titulo">Titulo</label>
                <input type="text" size="40" name="title" id="title" value="<?php if ($id != 0)
                    echo $dados['title']; ?>" required><br>

                <label for="resumo">Resumo</labe>
                <input type="text" size="40" name="resumo" id="resumo" value="<?php if ($id != 0)
                    echo $dados['Resumo']; ?>" required><br>

                <label for="Text">Texto</label>
                <input type="text" name="text" id="text" value="<?php if ($id != 0)
                    echo $dados['text']; ?>"><br>

                <label for="Autor">Autor</label>
                <input type="text" name="Autor" id="Autor" value="<?php if ($id != 0)
                    echo $dados['Autor']; ?>"><br>

                <label for='tags'>Tags</label>
                <input type="text" name='tags' id='tags' value="<?php if ($id != 0)
                    echo $dados['Tags']; ?>"><br>

                <input class="primary" type="submit" name="acao" id="acao" value="<?php if ($id == 0)
                    echo "Salvar";
                else
                    echo "Alterar";
                ?>">
                <input type="reset" value="Cancelar" />

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>