<div class="modal fade" id="modal-create-product" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Product</h4>

            </div>
            <div class="modal-body">
                <form action="{{route('product.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Product</label>
                        <input type="text" name="pd_nama" id="pd_nama" class="form-control" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select class="form-control select2" name="pd_kategori" id="pd_kategori" required>
                            <option hidden disabled selected>Pilih Kategori</option>
                            <option value="Valves">Valves</option>
                            <option value="Flanges">Flanges</option>
                            <option value="Fittings">Fittings</option>
                            <option value="Pipes">Pipes</option>
                            <option value="Sealing">Sealing</option>
                            <option value="Services">Services</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <select class="form-control select2" name="pd_brand" id="pd_brand" required>
                            <option value="" disabled selected>Pilih Brand</option>
                            <option value="GLT Valves">GLT Valves</option>
                            <option value="ROTORK">ROTORK</option>
                            <option value="Sferova">Sferova</option>
                            <option value="Fujikin">Fujikin</option>
                            <option value="Samshin">Samshin</option>
                            <option value="VM">VM</option>
                            <option value="M.Geldbach">M.Geldbach</option>
                            <option value="INOC">INOC</option>
                            <option value="ULMA">ULMA</option>
                            <option value="Tectubi">Tectubi</option>
                            <option value="Both-Well">Both-Well</option>
                            <option value="Spindo">Spindo</option>
                            <option value="Bakrie">Bakrie</option>
                            <option value="Valqua">Valqua</option>
                            <option value="Tubos">Tubos</option>
                            <option value="ArcelorMittal">ArcelorMittal</option>
                            <option value="Seah Steel">Seah Steel</option>
                            <option value="Baosteel">Baosteel</option>
                            <option value="TPCO">TPCO</option>
                            <option value="Klinger">Klinger</option>
                            <option value="Tombo">Tombo</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tipe</label>
                        <select class="form-control select2" name="pd_tipe" id="pd_tipe">
                            <option value="" hidden disabled selected>Pilih Tipe</option>
                            <option value="" disabled>-VALVES-</option>
                            <option value="Gate Valves">Gate Valves</option>
                            <option value="Globe Valves">Globe Valves</option>
                            <option value="Check Valves">Check Valves</option>
                            <option value="Ball Valves">Ball Valves</option>
                            <option value="Butterfly Valves">Butterfly Valves</option>
                            <option value="Instrumentation">Instrumentation</option>
                            <option value="Y-Strainers">Y-Strainers</option>
                            <option value="" disabled>-FLANGES-</option>
                            <option value="Welding Neck">Welding Neck</option>
                            <option value="Slip On">Slip On</option>
                            <option value="Blind">Blind</option>
                            <option value="Threaded">Threaded</option>
                            <option value="Socket Weld">Socket Weld</option>
                            <option value="" disabled>-FITTINGS-</option>
                            <option value="Elbows">Elbows</option>
                            <option value="Tees">Tees</option>
                            <option value="Reducers">Reducers</option>
                            <option value="Caps">Caps</option>
                            <option value="" disabled>-PIPING-</option>
                            <option value="Piping">Piping</option>
                            <option value="" disabled>-SEALINGS-</option>
                            <option value="Spiral Wound Gasket">Spiral Wound Gasket</option>
                            <option value="Ring Joint Gasket">Ring Joint Gasket</option>
                            <option value="Jointing Sheets">Jointing Sheets</option>
                            <option disabled>-SERVICES-</option>
                            <option value="Valves Pressure Testing">Valves Pressure</option>
                            <option value="Valves Inspection">Valves Inspection</option>
                            <option value="Material Inspection">Material Inspection</option>
                            <option value="Painting">Painting Painting</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Design</label>
                        <select class="form-control select2" name="pd_design" id="pd_design">
                            <option value="" disabled selected>Pilih Design</option>
                            <option value="" disabled>-VALVES-</option>
                            <option value="API 600">API 600</option>
                            <option value="API 602">API 602</option>
                            <option value="API 603">API 603</option>
                            <option value="API 608">API 608</option>
                            <option value="API 609">API 609</option>
                            <option value="API 6D">API 6D</option>
                            <option value="ASME B16.34">ASME B16.34</option>
                            <option value="Ansi 150">Ansi 150</option>
                            <option value="Ansi 300">Ansi 300</option>
                            <option value="Ansi " Ansi disabled>-FLANGES-</option>
                            <option value="ASME B16.5">ASME B16.5</option>
                            <option value="ASME B16.47">ASME B16.47</option>
                            <option value="API 6A">API 6A</option>
                            <option value="" disabled>-FITTINGS--</option>
                            <option value="ASME B16.9">ASME B16.9</option>
                            <option value="ASME B16.11">ASME B16.11</option>
                            <option value="" disabled>-PIPING-</option>
                            <option value="API 5L PSL 1">API 5L PSL 1</option>
                            <option value="PSL 2">PSL 2</option>
                            <option value="" disabled>-SEALINGS-</option>
                            <option value="ASME B16.5">ASME B16.5</option>
                            <option value="ASME B16.20">ASME B16.20</option>
                            <option value="" disabled>-SERVICES-</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Material</label>
                        <select class="form-control select2" name="pd_material" id="pd_material">
                            <option disabled selected>Pilih Material</option>
                            <option disabled>-VALVES-</option>
                            <option value="LCB">LCB</option>
                            <option value="WCB">WCB</option>
                            <option value="WCC">WCC</option>
                            <option value="Duplex">Duplex</option>
                            <option value="Superduplex">Superduplex</option>
                            <option value="exotic materials">exotic materials</option>
                            <option value="" disabled>-FLANGES-</option>
                            <option value="A105">A105</option>
                            <option value="LF2">LF2</option>
                            <option value="F304/L">F304/L</option>
                            <option value="F316/L">F316/L</option>
                            <option value="" disabled>-FITTINGS-</option>
                            <option value="WPB">WPB</option>
                            <option value="WP5">WP5</option>
                            <option value="WP304/L">WP9</option>
                            <option value="WP321">WP321</option>
                            <option value="ASTM A53">ASTM A53</option>
                            <option value="A106">A106</option>
                            <option value="" disabled>-SEALINGS-</option>
                            <option value="CS">CS</option>
                            <option value="SS304/L">SS304/L</option>
                            <option value="Graphite">Graphite</option>
                            <option value="" disabled>-SERVICES-</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" name="pd_harga" id="money" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- @endsection --}}
