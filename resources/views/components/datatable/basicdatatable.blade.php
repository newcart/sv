<div>
    <div class="row mt-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">{{ $tableTitle }}</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div id="{{ $tableId }}" class="data-table vue-table table-responsive p-0" source="{{ $source }}">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            @foreach($visibleCols as $visibleCol=>$visibleColTitle)
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ $visibleColTitle }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in rows" >
                            @foreach($visibleCols as $visibleCol=>$visibleColTitle)
                                @php
                                    $visibleCol = 'row.'.$visibleCol.'';
                                @endphp
                                <td  v-html="<?=$visibleCol?>" class="align-middle text-center text-sm "></td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" v-if="pages">
                            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true" class=""><</span></a></li>
                            <li class="page-item"  v-for=" i in pages">
                                <a class="page-link" href="#" aria-label="Previous" :class="{ 'bg-info': page==i }">
                                    <span aria-hidden="true" v-bind:class="{ 'text-white': page==i }" @click="loadPage( i )" >@{{ page_number(i)  }}</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true" class="">></span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<script>
    panel._createDataTable('.data-table', {});
    panel.vueTable['{{ $tableId }}'].loadPage(0);
</script>
</div>
