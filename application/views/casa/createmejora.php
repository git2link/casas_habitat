
    <div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-wrench"></i>
            Mejora
          </h3>

        </div> <!-- /.portlet-header -->

        <div class="portlet-content">

        <div class="table-responsive">
        <button id="test">
          test
        </button>
          <table 
            class="table table-striped table-bordered table-hover table-highlight table-checkable" 
            data-provide="datatable" 
            data-display-rows="10"
            data-info="true"
            data-search="true"
            data-length-change="true"
            data-paginate="true"
          >
              <thead>
                <tr>
                <th hidden data-filterable="true" data-sortable="true" data-direction="asc" > Casa_k </th>
                <th data-filterable="true" data-sortable="true" > Presupuesto </th>
                <th data-filterable="true" data-sortable="true" > Proveedor </th>
                <th data-filterable="true" data-sortable="true" > Proveedor </th>
                </tr>
              </thead>
              <tbody id="tbody_1">
                <?php foreach ($query as $registro): ?>
                    <tr id="1">
                        <td hidden> <?= $registro->casa_k ?> </td>
                        
                        <td > <select name="prov_1_"<?= $registro->proveedor_k ?> disabled>
                                <option value="<?= $registro->proveedor_k ?>">
                                <?= $registro->proveedor_k ?>
                                </option>
                            </select> 
                        </td>
                        <td> <input value="<?= $registro->presupuesto ?>" disabled></input> </td>
                        <td><button class="tr_remove" reference="1">eliminar</button></td>

                    </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>


        </div> <!-- /.portlet-content -->

      </div> <!-- /.portlet -->

      