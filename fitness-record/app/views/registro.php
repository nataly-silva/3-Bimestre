<?php include 'layout-top.php';
?>


<form method='POST' action='<?=route('registro/salvar/'._v($data,"id"))?>'>
<h1>Registro</h1>
<label class='col-md-6'>
    Nome <span style='color:red;'>*</span>
    <input type="text" class="form-control <?=hasError("nome","is-invalid")?>"  name="nome" value="<?=old("nome", _v($data,"nome"))?>" >
    <div class='invalid-feedback'><?=getValidationError("nome") ?></div>
</label>

<label class='col-md-6' style='position:relative'>
    Data de nascimento <span style='color:red;'>*</span>
    <input type="text" class="form-control <?=hasError("dataNascimento","is-invalid")?>" name="dataNascimento"
            value="<?=old("dataNascimento", _v($data,"dataNascimento"))?>" >

    <!-- para esse formato (invalid-tooltip) funcionar, o parent tem que ser relative -->
    <div class="invalid-feedback"><?=getValidationError("dataNascimento") ?></div>
</label>


<label class='col-md-6'>
    Email
    <input type="email" class="form-control <?=hasError("email","is-invalid")?>" name="email" value="" >
    <div class='invalid-feedback'><?=getValidationError("email") ?></div>
</label>
<label class='col-md-6'>
    Senha
    <input type="password" class="form-control <?=hasError("senha","is-invalid")?>" name="senha" value="" >
    <div class='invalid-feedback'><?=getValidationError("senha") ?></div>
</label>
<label class='col-md-6'>
    Situação
    <select name="tipo" class="form-control" id="opcao">
        <option selected hidden>Escolha o tipo</option>
        <?php
        $selected= _v($data,"tipo");
        foreach($tipoUser as $tipo => $valor){
            print "<option value='".$tipo."'>".$valor."</option>";
        }
        ?>
    </select>
</label>
<button class='btn btn-primary col-12 col-md-3 mt-3'>Criar</button>
<a class='btn btn-secondary col-12 col-md-3 mt-3' href="<?=route("login")?>">Logar</a>

</form>


<?php include 'layout-bottom.php' ?>