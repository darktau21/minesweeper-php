<?php $field = $data['field']; ?>
<div class="container">
    <div class="wrapper">
        <div class="game">
            <div class="controls">
                <div class="bombs-counter">
                    <svg class="bombs-counter__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30"
                         height="30">
                        <path
                            d="m411.313,123.313c6.25-6.25 6.25-16.375 0-22.625s-16.375-6.25-22.625,0l-32,32-9.375,9.375-20.688-20.688c-12.484-12.5-32.766-12.5-45.25,0l-16,16c-1.261,1.261-2.304,2.648-3.31,4.051-21.739-8.561-45.324-13.426-70.065-13.426-105.867,0-192,86.133-192,192s86.133,192 192,192 192-86.133 192-192c0-24.741-4.864-48.327-13.426-70.065 1.402-1.007 2.79-2.049 4.051-3.31l16-16c12.5-12.492 12.5-32.758 0-45.25l-20.688-20.688 9.375-9.375 32.001-31.999zm-219.313,100.687c-52.938,0-96,43.063-96,96 0,8.836-7.164,16-16,16s-16-7.164-16-16c0-70.578 57.422-128 128-128 8.836,0 16,7.164 16,16s-7.164,16-16,16z"/>
                        <path
                            d="m459.02,148.98c-6.25-6.25-16.375-6.25-22.625,0s-6.25,16.375 0,22.625l16,16c3.125,3.125 7.219,4.688 11.313,4.688 4.094,0 8.188-1.563 11.313-4.688 6.25-6.25 6.25-16.375 0-22.625l-16.001-16z"/>
                        <path
                            d="m340.395,75.605c3.125,3.125 7.219,4.688 11.313,4.688 4.094,0 8.188-1.563 11.313-4.688 6.25-6.25 6.25-16.375 0-22.625l-16-16c-6.25-6.25-16.375-6.25-22.625,0s-6.25,16.375 0,22.625l15.999,16z"/>
                        <path
                            d="m400,64c8.844,0 16-7.164 16-16v-32c0-8.836-7.156-16-16-16-8.844,0-16,7.164-16,16v32c0,8.836 7.156,16 16,16z"/>
                        <path
                            d="m496,96.586h-32c-8.844,0-16,7.164-16,16 0,8.836 7.156,16 16,16h32c8.844,0 16-7.164 16-16 0-8.836-7.156-16-16-16z"/>
                        <path
                            d="m436.98,75.605c3.125,3.125 7.219,4.688 11.313,4.688 4.094,0 8.188-1.563 11.313-4.688l32-32c6.25-6.25 6.25-16.375 0-22.625s-16.375-6.25-22.625,0l-32,32c-6.251,6.25-6.251,16.375-0.001,22.625z"/>
                    </svg>
                    <span class="bombs-counter__count"><?= $field->bombs_count - $field->marked_cells_count ?></span>
                </div>
                <div class="btns">
                    <a href="/reset-session">
                        <svg class="restart__icon" version="1.1" height="30px" width="30px" id="Capa_1"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 489.533 489.533" style="enable-background:new 0 0 489.533 489.533;"
                             xml:space="preserve">
                    <path d="M268.175,488.161c98.2-11,176.9-89.5,188.1-187.7c14.7-128.4-85.1-237.7-210.2-239.1v-57.6c0-3.2-4-4.9-6.7-2.9
                    l-118.6,87.1c-2,1.5-2,4.4,0,5.9l118.6,87.1c2.7,2,6.7,0.2,6.7-2.9v-57.5c87.9,1.4,158.3,76.2,152.3,165.6
                    c-5.1,76.9-67.8,139.3-144.7,144.2c-81.5,5.2-150.8-53-163.2-130c-2.3-14.3-14.8-24.7-29.2-24.7c-17.9,0-31.9,15.9-29.1,33.6
                    C49.575,418.961,150.875,501.261,268.175,488.161z"/>
                </svg>
                    </a>
                </div>
            </div>
            <div class="field">
                <?php if ($field->state === 'win' || $field->state === 'lose') { ?>
                    <div class="msg">
                        <span>
                        <?= $data['title'] ?>
                        </span>
                    </div>
                <?php }
                for ($y = 0; $y < $field->size; $y++) { ?>
                    <div class="row">
                        <?php
                        for ($x = 0; $x < $field->size; $x++) {
                            $cell = $field->grid[$y][$x];
                            ?>
                            <div class="cell <?= $cell->is_exploded ? 'cell_exploded' : '' ?>">
                                <form action="/" method="post" class="open">
                                    <input name="open_cell_x" type="number" value="<?= $x ?>" hidden="hidden">
                                    <input name="open_cell_y" type="number" value="<?= $y ?>" hidden="hidden">
                                </form>
                                <form action="/" method="post" class="mark">
                                    <input name="mark_cell_x" type="number" value="<?= $x ?>" hidden="hidden">
                                    <input name="mark_cell_y" type="number" value="<?= $y ?>" hidden="hidden">
                                </form>
                                <?php switch ($cell->bombs_around_count) {
                                    case 1:
                                        ?>
                                        <div class="cell_counter cell_counter_1">
                                            1
                                        </div>
                                        <?php break;
                                    case 2:
                                        ?>
                                        <div class="cell_counter cell_counter_2">
                                            2
                                        </div>
                                        <?php break;
                                    case 3:
                                        ?>
                                        <div class="cell_counter cell_counter_3">
                                            3
                                        </div>
                                        <?php break;
                                    case 4:
                                        ?>
                                        <div class="cell_counter cell_counter_4">
                                            4
                                        </div>
                                        <?php break;
                                    case 5:
                                        ?>
                                        <div class="cell_counter cell_counter_5">
                                            5
                                        </div>
                                        <?php break;
                                    case 6:
                                        ?>
                                        <div class="cell_counter cell_counter_6">
                                            6
                                        </div>
                                        <?php break;
                                    case 7:
                                        ?>
                                        <div class="cell_counter cell_counter_7">
                                            7
                                        </div>
                                        <?php break;
                                    case 8:
                                        ?>
                                        <div class="cell_counter cell_counter_8">
                                            8
                                        </div>
                                        <?php break;
                                } ?>
                                <?php if (!$cell->is_opened) { ?>
                                    <div class="cap"></div>
                                <?php } ?>
                                <?php if ($cell->has_bomb) { ?>
                                    <svg class="bomb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                         width="30"
                                         height="30">
                                        <path
                                            d="m411.313,123.313c6.25-6.25 6.25-16.375 0-22.625s-16.375-6.25-22.625,0l-32,32-9.375,9.375-20.688-20.688c-12.484-12.5-32.766-12.5-45.25,0l-16,16c-1.261,1.261-2.304,2.648-3.31,4.051-21.739-8.561-45.324-13.426-70.065-13.426-105.867,0-192,86.133-192,192s86.133,192 192,192 192-86.133 192-192c0-24.741-4.864-48.327-13.426-70.065 1.402-1.007 2.79-2.049 4.051-3.31l16-16c12.5-12.492 12.5-32.758 0-45.25l-20.688-20.688 9.375-9.375 32.001-31.999zm-219.313,100.687c-52.938,0-96,43.063-96,96 0,8.836-7.164,16-16,16s-16-7.164-16-16c0-70.578 57.422-128 128-128 8.836,0 16,7.164 16,16s-7.164,16-16,16z"/>
                                        <path
                                            d="m459.02,148.98c-6.25-6.25-16.375-6.25-22.625,0s-6.25,16.375 0,22.625l16,16c3.125,3.125 7.219,4.688 11.313,4.688 4.094,0 8.188-1.563 11.313-4.688 6.25-6.25 6.25-16.375 0-22.625l-16.001-16z"/>
                                        <path
                                            d="m340.395,75.605c3.125,3.125 7.219,4.688 11.313,4.688 4.094,0 8.188-1.563 11.313-4.688 6.25-6.25 6.25-16.375 0-22.625l-16-16c-6.25-6.25-16.375-6.25-22.625,0s-6.25,16.375 0,22.625l15.999,16z"/>
                                        <path
                                            d="m400,64c8.844,0 16-7.164 16-16v-32c0-8.836-7.156-16-16-16-8.844,0-16,7.164-16,16v32c0,8.836 7.156,16 16,16z"/>
                                        <path
                                            d="m496,96.586h-32c-8.844,0-16,7.164-16,16 0,8.836 7.156,16 16,16h32c8.844,0 16-7.164 16-16 0-8.836-7.156-16-16-16z"/>
                                        <path
                                            d="m436.98,75.605c3.125,3.125 7.219,4.688 11.313,4.688 4.094,0 8.188-1.563 11.313-4.688l32-32c6.25-6.25 6.25-16.375 0-22.625s-16.375-6.25-22.625,0l-32,32c-6.251,6.25-6.251,16.375-0.001,22.625z"/>
                                    </svg>

                                <?php }
                                if ($cell->is_marked) { ?>
                                    <svg class="flag"
                                         width="30px" height="40px"
                                         xmlns:dc="http://purl.org/dc/elements/1.1/"
                                         xmlns:cc="http://creativecommons.org/ns#"
                                         xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                         xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                         xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                         xml:space="preserve"
                                         style="shape-rendering:geometricPrecision; image-rendering:optimizeQuality"
                                         viewBox="0 0 250 352" id="svg2436" sodipodi:version="0.32"
                                         inkscape:version="0.46" sodipodi:docname="flag icon red 4.svg"
                                         inkscape:output_extension="org.inkscape.output.svg.inkscape"><metadata
                                            id="metadata2445">
                                            <rdf:RDF>
                                                <cc:Work rdf:about="">
                                                    <dc:format>image/svg+xml</dc:format>
                                                    <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/>
                                                </cc:Work>
                                            </rdf:RDF>
                                        </metadata>
                                        <defs id="defs2443">
                                            <inkscape:perspective sodipodi:type="inkscape:persp3d"
                                                                  inkscape:vp_x="0 : 175.5 : 1"
                                                                  inkscape:vp_y="0 : 1000 : 0"
                                                                  inkscape:vp_z="250 : 175.5 : 1"
                                                                  inkscape:persp3d-origin="125 : 117 : 1"
                                                                  id="perspective2447"/>
                                        </defs>
                                        <sodipodi:namedview inkscape:window-height="974" inkscape:window-width="1280"
                                                            inkscape:pageshadow="2" inkscape:pageopacity="0.0"
                                                            guidetolerance="10.0" gridtolerance="10.0"
                                                            objecttolerance="10.0" borderopacity="1.0"
                                                            bordercolor="#666666" pagecolor="#ffffff" id="base"
                                                            showgrid="false" inkscape:zoom="1.3162393" inkscape:cx="125"
                                                            inkscape:cy="175.5" inkscape:window-x="-8"
                                                            inkscape:window-y="-8" inkscape:current-layer="svg2436"/>
                                        <path style="fill:none;stroke:#000000;stroke-width:21;stroke-linecap:round"
                                              d="M42 327l0 -291" id="path2438"/>
                                        <path style="fill:#ff2a2a;stroke:#000000;stroke-width:10;stroke-linejoin:round"
                                              d="M49 50c70,30 104,28 178,2 -21,42 -21,74 0,116 -72,25 -101,25 -178,0l0 -118z"
                                              id="path2440"/>
</svg>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="/public/script.js"></script>