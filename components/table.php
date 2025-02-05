<style>
    .grid-item {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #000;
        margin: 5px;
        font-weight: bold;
    }

    #tableInformationContainer {
        display: none;
    }
</style>

<div class="row">

    <div class="col-lg-12" id="tableContainer">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tables</h5>

                <div class="container d-flex justify-content-center align-items-center vh-90">
                    <div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item" onclick="openModal()">5</button>
                            <button class="grid-item" onclick="openModal()">11</button>
                        </div>
                        <div class="d-flex">
                            <button class="grid-item" onclick="openModal()">1</button>
                            <button class="grid-item" onclick="openModal()">3</button>
                            <button class="grid-item" onclick="openModal()">6</button>
                            <button class="grid-item" onclick="openModal()">12</button>
                        </div>
                        <div class="d-flex ">
                            <button class="grid-item" onclick="openModal()">2</button>
                            <button class="grid-item" onclick="openModal()">4</button>
                            <button class="grid-item" onclick="openModal()">7</button>
                            <button class="grid-item" onclick="openModal()">14</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item" onclick="openModal()">8</button>
                            <button class="grid-item" onclick="openModal()">15</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item" onclick="openModal()">9</button>
                            <button class="grid-item" onclick="openModal()">16</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="grid-item" onclick="openModal()">10</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="col-lg-5 " id="tableInformationContainer" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Table Information</h5>
                            <ul>
                                <li>asdfas</li>
                                <li>asdfas</li>
                                <li>asdfas</li>
                                <li>asdfas</li>
                            </ul>
                            <hr>
                            <h6 class=" d-flex justify-content-end"><span class="bold">$ </span> 40</h6>


                        </div>
                        <div class="modal-footer m-1">
                            <button type="button" class="btn btn-secondary m-2" onclick="closecModal()">Close</button>
                            <button type="button" class="btn btn-primary m-2">Reciept</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    function closecModal() {
        var tableContainer = document.getElementById("tableContainer");
        tableContainer.className = "col-lg-12";

        var tableInformationContainer = document.getElementById("tableInformationContainer");
        tableInformationContainer.style.display = 'none';
    }

    function openModal() {
        var tableContainer = document.getElementById("tableContainer");
        tableContainer.className = "col-lg-7";

        var tableInformationContainer = document.getElementById("tableInformationContainer");
        tableInformationContainer.style.display = 'block';
    }
</script>