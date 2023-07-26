<?php include 'layout-top.php';

// print_r( _v($data,"situacao"));
?>


<form method='POST' action='<?=route('usuarios/salvar/'._v($data,"id"))?>'>

<label class='col-md-6'>
    Selecione o login:
    <select name="id_login" class="form-control" id="selecao">
        <option selected hidden>Escolha uma opção</option>
        <?php
        foreach($logins as $login){
            _v($data,"id_login") == $login['id'] ? $selected='selected' : $selected='';
            print "<option value='{$login['id']}' $selected>{$login['nome']}</option>";
        }
        ?>
    </select>
</label>



<label class='col-md-2'>
    Objetivo
    <br>
    <input type="checkbox" class="form-check-input" name="obj[]" value="1" <?= mb_strpos(_v($data,'objetivo'),"Saúde") !== false ? 'checked' : '' ?> >
    Saúde
    <br>
    <input type="checkbox" class="form-check-input" name="obj[]" value="2" <?= mb_strpos(_v($data,'objetivo'),"Hipertrofia") !== false ? 'checked' : '' ?> >
    Hipertrofia
    <br>
    <input type="checkbox" class="form-check-input" name="obj[]" value="3" <?= mb_strpos(_v($data,'objetivo'),"Perca de Peso") !== false ? 'checked' : '' ?> >
    Perca de Peso
</label>

<label class='col-md-2'>
    Endereço
    <input type="text" class="form-control" name="endereco" value="<?=_v($data,"endereco")?>" >
</label>

<label class='col-md-2'>
    Celular
    <input type="text" class="form-control" name="celular" placeholder="(xx)xxxxx-xxxx" value="<?=_v($data,"celular")?>" >
</label>

<label class='col-md-6'>
    Situação
    <select name="situacao" class="form-control">
        <option selected hidden>Escolha uma opção</option>
        <?php
        $selected= '';
        foreach($tiposSi as $tipo){
            $selected= $tipo["id"] == _v($data,"situacao") ? "selected" : '';
            print "<option value=".$tipo['id']." $selected>".$tipo["tipo"]."</option>";
        }
        ?>
    </select>
</label>

<button class='btn btn-primary col-12 col-md-3 mt-3'>Salvar</button>
<a class='btn btn-secondary col-12 col-md-3 mt-3' href="<?=route("usuarios")?>">Novo</a>

</form>

<table class='table'>

    <tr>
        <th>Editar</th>
        <th>Nome</th>
        <th>Data de nascimento</th>
        <th>Objetivo</th>
        <th>Endereço</th>
        <th>Celular</th>
        <th>Situação</th>
        <th>Deletar</th>
    </tr>

    <?php foreach($lista as $item): ?>

        <tr>
            <td>
                <a href='<?=route("usuarios/index/{$item['id']}")?>'>Editar</a>
            </td>
            <td><?=$item['nome']?></td>
            <td><?=$item['dataNascimento']?></td>
            
            <td><?=$item['objetivo']?></td>
            <td><?=$item['endereco']?></td>
            <td><?=$item['celular']?></td>
            <?php 
                $count = 0;
                foreach($tiposSi as $v=>$tipo){
                    if($item['situacao'] == $tipo['id'])
                        print "<td>".$tipo['tipo']."</td>";
                    else if($v==1 && $count >0)
                        print "<td></td>";
                    else 
                        $count ++;
                }
                ?>

            <td>
                <a href='<?=route("usuarios/deletar/{$item['id']}")?>'>Deletar</a>
            </td>
        </tr>

    <?php endforeach; ?>
</table>

<?php include 'layout-bottom.php' ?>