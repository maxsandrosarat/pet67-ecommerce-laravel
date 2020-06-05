<div id="filtros" class="col">
    <div class="card-deck ">
        <div class="card border border-primary">
            <div class="card-body bg-light mb-3">
                <h5>Busca</h5>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/busca">
                    @csrf
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="categoria">
                        <option value="">__Selecione__</option>
                        @foreach ($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->nome}}</option>
                        @endforeach
                    </select>
                    <br/><br/>
                    <label for="tipo">Tipo do Animal:</label>
                    <select id="tipo" name="tipo">
                        <option value="">__Selecione__</option>
                        @foreach ($tipos as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                        @endforeach
                    </select>
                    <br/><br/>
                    <label for="fase">Fase do Animal:</label>
                    <select id="fase" name="fase">
                        <option value="">__Selecione__</option>
                        <option value="filhote">Filhote</option>
                        <option value="adulto">Adulto</option>
                        <option value="castrado">Castrado</option>
                        <option value="todas">Todas</option>
                    </select>
                    <br/><br/>
                    <label for="marca">Marca do Produto:</label>
                    <select id="marca" name="marca">
                        <option value="">__Selecione__</option>
                        @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->nome}}</option>
                        @endforeach
                    </select>
                    <br/><br/>
                    <input class="form-control mr-sm-2" type="text" size="15" placeholder="Nome do Produto" name="nome" id="nome">
                    <br/><br/>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>