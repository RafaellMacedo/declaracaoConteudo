<div class="container-fluid">
            <span class="grupo">
                <h3 class="card-title"><b>Destinatario</b></h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="destinatario[nome]" id="destinatario[nome]" placeholder="Informe o primeiro Nome">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" class="form-control cpf" name="destinatario[cpf]" id="destinatario[cpf]" placeholder="Informe seu CPF">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" class="form-control cep destinatario_cep" name="destinatario[cep]" id="destinatario[cep]" placeholder="Informe o CEP">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group center">
                            <button type="button" class="btn btn-primary btnConsultaCep" id="btn_destinatario">Consultar CEP</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Endereço</label>
                            <input type="text" class="form-control destinatario_endereco" name="destinatario[endereco]" id="destinatario[endereco]">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Número</label><span class="obrigatorio">*</span>
                            <input type="text" class="form-control destinatario_numero" name="destinatario[numero]" id="destinatario[numero]" placeholder="Informe o número">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Complemento</label>
                            <input type="text" class="form-control destinatario_complemento" name="destinatario[complemento]" id="destinatario[complemento]" placeholder="Informe o seu Complemento">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Bairro</label>
                            <input type="text" class="form-control destinatario_bairro" name="destinatario[bairro]" id="destinatario[bairro]">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control destinatario_estado" id="destinatario[estado]" name="destinatario[estado]">
                                <option value=""></option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Cidade</label>
                            <select class="form-control destinatario_cidade" id="destinatario[cidade]" name="destinatario[cidade]">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
            </span>
        </div>