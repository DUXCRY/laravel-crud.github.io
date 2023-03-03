<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Models\CustomerModel;

class Grafik
{
    private $db;

    function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function grafik($query)
    {
        $query = $this->db->prepare(
            DB::select()
        );
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data   = $row['kategori'];
            $jumlah = $row['jumlah'];

?>
            {

            name: '<?php echo $data; ?>',
            y: <?php echo $jumlah; ?>

            },
<?php
        }
    }
}
?>