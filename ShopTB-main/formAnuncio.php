<?php include "header.php" ?>

    <!-- Seção para conteúdo da página -->
    <section class="py-5">

        <div class="d-flex justify-content-center mb-3">

            <div class="row">
                <div class="col">
                    
                    <h2>Criar Anúncio:</h2>

                    <form action="actionAnuncio.php" method="POST" class="was-validated" enctype="multipart/form-data">

                        <div class="form-floating mt-3 mb-3">
                            <input type="file" class="form-control" id="fotoAnuncio" placeholder="Foto do Anúncio" name="fotoAnuncio">
                            <label for="fotoAnuncio">Foto do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="tituloAnuncio" placeholder="Titúlo do Anúncio" name="tituloAnuncio">
                            <label for="tituloAnuncio">Titulo do Anuncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <select class="form-select" id="categoriaAnuncio" name="categoriaAnuncio" placeholder="Categoria">
                                <option value="games">Games</option>
                                <option value="veiculos">Veículos</option>
                                <option value="vestuarios">Vestuários</option>
                                <option value="imoveis">Imóveis</option>
                                <option value="alimentos" selected>Alimentos</option>
                                <option value="outro(a)">Outra</option>
                            </select>
                            <label for="cidadeUsuario">Categoria do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                           <textarea class="form-control" id="descricaoAnuncio" placeholder="Informe uma breve descrição dop seu anúncio" name="descricaoAnuncio"></textarea>
                            <label for="descricaoAnuncio">Descrição do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" class="form-control" id="valorAnuncio" placeholder="Valor do Anúncio" name="valorAnuncio">
                            <label for="valorAnuncio">Valor do Anúncio</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <button type="submit" class="btn btn-success">Criar Anúncio</button>
                    </form>

                </div>
            </div>

        </div>

    </section>

<?php include "footer.php" ?>