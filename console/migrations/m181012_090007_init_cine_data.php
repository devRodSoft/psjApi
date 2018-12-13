<?php

use yii\db\Migration;

/**
 * Class m181012_090007_init_cine_data
 */
class m181012_090007_init_cine_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("INSERT INTO `cine` (`nombre`, `direccion`, `telefono`) VALUES ('san javier', 'hh300', '1234567890');");

        $this->execute("INSERT INTO `director` (`nombre`) VALUES ('Quentin Tarantino'),('Christopher Nolan'),('Guillermo del Toro');");

        $this->execute("INSERT INTO `pelicula` (`id`, `nombre`, `genero`, `calificacion`, `clasificacion`, `idioma`, `duracion`, `sinopsis`, `cartelUrl`, `trailerUrl`, `trailerImg`, `director_id`) VALUES ('1', 'Inception', 'drama', '4.9', 'A', 'español', '110', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quibusdam, ut iste totam facere error, vitae accusantium cumque aut nulla quaerat non rerum ratione fugit nemo sed magni? Obcaecati, soluta.', 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SY1000_CR0,0,675,1000_AL_.jpg',
'https://video-http.media-imdb.com/MV5BNDU1MTc1MmMtYjhmOC00NmNkLThlNDItMDI1MTQ3NjlkNTliXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1538589197&Signature=IVR2oBaiGqZy~Zyo6KxP7nSCC8oLYg98dVFDh5BkzsO-D1Xk7VyzgXFU5VXbCuFDkO7FrEKZW1uWM-WPWJ3DFPB6kIK3OMPbg6rNnR9KlEcu1fYplXaS984mC7m0cC9sJivKic4y2N7f2tmuvpqqQ8Rv6mgXFBDsS-8htEEt74_&Key-Pair-Id=APKAILW5I44IHKUN2DYA', 'https://m.media-amazon.com/images/M/MV5BNTdlZGFmMDQtM2RiYi00NzUxLThhZWQtN2M4ZmYwMzllZGYyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_CR251,0,1419,798_AL_UY268_CR84,0,477,268_AL_.jpg', '2'),('2', 'Venom',  'drama', '4.5', 'A', 'español', '110', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quibusdam, ut iste totam facere error, vitae accusantium cumque aut nulla quaerat non rerum ratione fugit nemo sed magni? Obcaecati, soluta.', 'https://m.media-amazon.com/images/M/MV5BNzAwNzUzNjY4MV5BMl5BanBnXkFtZTgwMTQ5MzM0NjM@._V1_.jpg',
'https://video-http.media-imdb.com/MV5BNDU1MTc1MmMtYjhmOC00NmNkLThlNDItMDI1MTQ3NjlkNTliXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1538589197&Signature=IVR2oBaiGqZy~Zyo6KxP7nSCC8oLYg98dVFDh5BkzsO-D1Xk7VyzgXFU5VXbCuFDkO7FrEKZW1uWM-WPWJ3DFPB6kIK3OMPbg6rNnR9KlEcu1fYplXaS984mC7m0cC9sJivKic4y2N7f2tmuvpqqQ8Rv6mgXFBDsS-8htEEt74_&Key-Pair-Id=APKAILW5I44IHKUN2DYA', 'https://m.media-amazon.com/images/M/MV5BNTdlZGFmMDQtM2RiYi00NzUxLThhZWQtN2M4ZmYwMzllZGYyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_CR251,0,1419,798_AL_UY268_CR84,0,477,268_AL_.jpg', '1'),('3', 'Daredevil',  'drama', '4.5', 'A', 'español', '110', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quibusdam, ut iste totam facere error, vitae accusantium cumque aut nulla quaerat non rerum ratione fugit nemo sed magni? Obcaecati, soluta.', 'https://m.media-amazon.com/images/M/MV5BNzAwNzUzNjY4MV5BMl5BanBnXkFtZTgwMTQ5MzM0NjM@._V1_.jpg',
'https://video-http.media-imdb.com/MV5BNDU1MTc1MmMtYjhmOC00NmNkLThlNDItMDI1MTQ3NjlkNTliXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1538589197&Signature=IVR2oBaiGqZy~Zyo6KxP7nSCC8oLYg98dVFDh5BkzsO-D1Xk7VyzgXFU5VXbCuFDkO7FrEKZW1uWM-WPWJ3DFPB6kIK3OMPbg6rNnR9KlEcu1fYplXaS984mC7m0cC9sJivKic4y2N7f2tmuvpqqQ8Rv6mgXFBDsS-8htEEt74_&Key-Pair-Id=APKAILW5I44IHKUN2DYA', 'https://m.media-amazon.com/images/M/MV5BNTdlZGFmMDQtM2RiYi00NzUxLThhZWQtN2M4ZmYwMzllZGYyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_CR251,0,1419,798_AL_UY268_CR84,0,477,268_AL_.jpg', '3'),('4', 'Iron Man',  'drama', '4.5', 'A', 'español', '110', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quibusdam, ut iste totam facere error, vitae accusantium cumque aut nulla quaerat non rerum ratione fugit nemo sed magni? Obcaecati, soluta.', 'https://m.media-amazon.com/images/M/MV5BNzAwNzUzNjY4MV5BMl5BanBnXkFtZTgwMTQ5MzM0NjM@._V1_.jpg',
'https://video-http.media-imdb.com/MV5BNDU1MTc1MmMtYjhmOC00NmNkLThlNDItMDI1MTQ3NjlkNTliXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1538589197&Signature=IVR2oBaiGqZy~Zyo6KxP7nSCC8oLYg98dVFDh5BkzsO-D1Xk7VyzgXFU5VXbCuFDkO7FrEKZW1uWM-WPWJ3DFPB6kIK3OMPbg6rNnR9KlEcu1fYplXaS984mC7m0cC9sJivKic4y2N7f2tmuvpqqQ8Rv6mgXFBDsS-8htEEt74_&Key-Pair-Id=APKAILW5I44IHKUN2DYA', 'https://m.media-amazon.com/images/M/MV5BNTdlZGFmMDQtM2RiYi00NzUxLThhZWQtN2M4ZmYwMzllZGYyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_CR251,0,1419,798_AL_UY268_CR84,0,477,268_AL_.jpg', '1'),('5', 'Batman: EL caballero de la noche asciende',  'drama', '4.5', 'A', 'español', '110', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quibusdam, ut iste totam facere error, vitae accusantium cumque aut nulla quaerat non rerum ratione fugit nemo sed magni? Obcaecati, soluta.', 'https://m.media-amazon.com/images/M/MV5BNzAwNzUzNjY4MV5BMl5BanBnXkFtZTgwMTQ5MzM0NjM@._V1_.jpg',
'https://video-http.media-imdb.com/MV5BNDU1MTc1MmMtYjhmOC00NmNkLThlNDItMDI1MTQ3NjlkNTliXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1538589197&Signature=IVR2oBaiGqZy~Zyo6KxP7nSCC8oLYg98dVFDh5BkzsO-D1Xk7VyzgXFU5VXbCuFDkO7FrEKZW1uWM-WPWJ3DFPB6kIK3OMPbg6rNnR9KlEcu1fYplXaS984mC7m0cC9sJivKic4y2N7f2tmuvpqqQ8Rv6mgXFBDsS-8htEEt74_&Key-Pair-Id=APKAILW5I44IHKUN2DYA', 'https://m.media-amazon.com/images/M/MV5BNTdlZGFmMDQtM2RiYi00NzUxLThhZWQtN2M4ZmYwMzllZGYyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_CR251,0,1419,798_AL_UY268_CR84,0,477,268_AL_.jpg', '1');");

        $this->execute("INSERT INTO `sala` (`id`, `cine_id`, `nombre`, `created_at`, `updated_at`) VALUES ('1', '1', 'Sala 3', '2018-10-13 17:49:39', '2018-10-13 17:49:39'),
('2', '1', 'Sala 4', '2018-10-13 17:49:39', '2018-10-13 17:49:39'),
('3', '1', 'Sala 5', '2018-10-13 17:49:58', '2018-10-13 17:49:58');");

        $this->execute("INSERT INTO `asiento` (`fila`, `numero`, `tipo`, `arreglo`) VALUES ('A', '1', 1, '1234567890'),('A', '2', 1, '1234567890'),('A', '3', 1, '1234567890'),('A', '4', 1, '1234567890'),('A', '5', 1, '1234567890'),('A', '6', 0, '1234567890'),('A', '7', 0, '1234567890'),('A', '8', 0, '1234567890'),('A', '9', 1, '1234567890'),('B', '1', 1, '1234567890'),('B', '2', 1, '1234567890'),('B', '3', 1, '1234567890'),('B', '4', 0, '1234567890'),('B', '5', 1, '1234567890'),('B', '6', 1, '1234567890'),('B', '7', 1, '1234567890'),('B', '8', 1, '1234567890'),('B', '9', 1, '1234567890'),('C', '1', 1, '1234567890'),('C', '2', 1, '1234567890'),('C', '3', 0, '1234567890'),('C', '4', 2, '1234567890'),('C', '5', 1, '1234567890'),('C', '6', 1, '1234567890'),('C', '7', 1, '1234567890'),('C', '8', 1, '1234567890'),('C', '9', 1, '1234567890'),('D', '1', 2, '1234567890'),('D', '2', 2, '1234567890'),('D', '3', 1, '1234567890'),('D', '4', 1, '1234567890'),('D', '5', 1, '1234567890'),('D', '6', 1, '1234567890'),('D', '7', 1, '1234567890'),('D', '8', 1, '1234567890'),('D', '9', 2, '1234567890'),('E', '1', 1, '1234567890'),('E', '2', 1, '1234567890'),('E', '3', 1, '1234567890'),('E', '4', 1, '1234567890'),('E', '5', 1, '1234567890'),('E', '6', 1, '1234567890'),('E', '7', 1, '1234567890'),('E', '8', 1, '1234567890'),('E', '9', 1, '1234567890'),('F', '1', 1, '1234567890'),('F', '2', 1, '1234567890'),('F', '3', 1, '1234567890'),('F', '4', 1, '1234567890'),('F', '5', 1, '1234567890'),('F', '6', 1, '1234567890'),('F', '7', 1, '1234567890'),('F', '8', 1, '1234567890'),('F', '9', 1, '1234567890');");

        $this->execute("INSERT INTO `sala_asientos` (`sala_id`, `asiento_id`)  SELECT s.id, a.id FROM sala s, asiento a");

        $this->execute("INSERT INTO `funcion` ( `cine_id`, `pelicula_id`, `precio`, `recomendada`, `created_at`, `updated_at`) VALUES ('1', '1', '100.00', '2018-10-13 18:56:26', '2018-10-13 18:56:26', '2018-10-13 18:56:26'),('1', '2', '100.00', '2018-10-13 18:56:26', '2018-10-13 18:56:26', '2018-10-13 18:56:26'),('1', '3', '35.00', '2018-10-13 18:56:26', '2018-10-13 18:56:26', '2018-10-13 18:56:26');");

        $this->execute("INSERT INTO `horario_funcion` (`funcion_id`, `hora`, `fecha`, `sala_id`) VALUES ( 1, '18:30:00', '2018-10-13', 1), ( 1, '20:30:00', '2018-10-13', 2), ( 2, '18:30:00', '2018-10-13', 3), ( 3, '18:30:00', '2018-10-13', 2);");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
