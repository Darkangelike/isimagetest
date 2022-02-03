<div class="container">
    <form action="?type=velo&action=new" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column">
            <h1>Ajoutez votre vélo à vendre dans notre magasin</h1>
            <input type="text" value="Super green gravel" name="name" placeholder="Entrez le nom du vélo ici" id="name">
            <textarea name="description" placeholder="Entrez une description du vélo" id="" cols="30" rows="10">Ready to follow you on any trail!</textarea>
            <input type="file" | name="imageVelo" id="imageVelo">
            <input type="number" value="250" name="price" placeholder="Mettez le prix du vélo" id="price">
            <input class="btn btn-info" type="submit" name="create" value="post">
        </div>
    
    </form>

</div>