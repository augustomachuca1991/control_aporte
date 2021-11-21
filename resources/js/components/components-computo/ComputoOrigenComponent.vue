<template>
    <div class="card">
        <div class="card-body">
            <ejs-grid
                locale="es-ES"
                :dataSource="origenes"
                :allowPaging="true"
                :allowSorting="true"
                :allowFiltering="true"
                :allowGrouping="true"
                :pageSettings="pageSettings"
            >
                <e-columns>
                    <e-column
                        field="origen"
                        headerText="Origen"
                        textAlign="left"
                        width="120"
                    ></e-column>
                    <e-column
                        field="periodo"
                        headerText="Periodo"
                        textAlign="Right"
                        format="C2"
                        width="90"
                    ></e-column>
                    <e-column
                        field="tipo_liquidacion"
                        headerText="Tipo Liquidación"
                        textAlign="Right"
                        format="C2"
                        width="90"
                    ></e-column>
                    <e-column
                        field="haber_bruto"
                        headerText="Total Haber Bruto"
                        textAlign="Right"
                        format="C2"
                        width="90"
                    ></e-column>
                    <e-column
                        field="total_aporte_personal"
                        headerText="Aporte Personal"
                        textAlign="Right"
                        format="C2"
                        width="90"
                    ></e-column>
                    <e-column
                        field="total_sueldo_basico"
                        headerText="Basico"
                        textAlign="Right"
                        format="C2"
                        width="90"
                    ></e-column>
                    <e-column
                        field="total_antiguedad"
                        headerText="Antiguedad"
                        textAlign="Right"
                        format="C2"
                        width="90"
                    ></e-column>
                    <e-column
                        field="total_adicional"
                        headerText="Adicional familiares"
                        textAlign="Right"
                        format="C2"
                        width="90"
                    ></e-column>
                </e-columns>
                <e-aggregates>
                    <e-aggregate>
                        <e-columns>
                            <e-column
                                type="Sum"
                                field="haber_bruto"
                                format="C2"
                                :footerTemplate="footerSum"
                            ></e-column>
                            <e-column
                                type="Sum"
                                field="total_aporte_personal"
                                format="C2"
                                :footerTemplate="footerSum"
                            ></e-column>
                            <e-column
                                type="Sum"
                                field="total_sueldo_basico"
                                format="C2"
                                :footerTemplate="footerSum"
                            ></e-column>
                            <e-column
                                type="Sum"
                                field="total_antiguedad"
                                format="C2"
                                :footerTemplate="footerSum"
                            ></e-column>
                            <e-column
                                type="Sum"
                                field="total_adicional"
                                format="C2"
                                :footerTemplate="footerSum"
                            ></e-column>
                        </e-columns>
                    </e-aggregate>
                </e-aggregates>
            </ejs-grid>
        </div>
    </div>
</template>

<script>
import { L10n, setCulture } from "@syncfusion/ej2-base";
import {
    Page,
    Sort,
    Filter,
    Group,
    Aggregate
} from "@syncfusion/ej2-vue-grids";
//import '@syncfusion/ej2-vue-grids/styles/material.css'

setCulture("es-ES");

L10n.load({
    "es-ES": {
        grid: {
            EmptyRecord: "Sin Registros",
            EmptyDataSourceError:
                "DataSource must not be empty at initial load since columns are generated from dataSource in AutoGenerate Column Grid",
            GroupDropArea:
                "Arrastre el encabezado de una columna aquí para agrupar su columna"
        },
        pager: {
            currentPageInfo: "{0} de {1} Paginas",
            totalItemsInfo: "	({0} Registros)",
            firstPageTooltip: "Primer Pagina",
            lastPageTooltip: "Fin Pagina",
            nextPageTooltip: "Siguente",
            previousPageTooltip: "Anterior",
            nextPagerTooltip: "Go to next pager",
            previousPagerTooltip: "Go to previous pager"
        }
    }
});
export default {
    props: ["origenes"],
    data() {
        return {
            pageSettings: { pageSize: 10 },
            footerSum: function() {
                return {
                    template: Vue.component("sumTemplate", {
                        template: `<span>Suma: {{data.Sum}}</span>`,
                        data() {
                            return { data: { data: {} } };
                        }
                    })
                };
            }
        };
    },
    provide: {
        grid: [Page, Sort, Filter, Group, Aggregate]
    }
    //computed:{
    //	  groups(){
    //	    return groupBy(this.origenes, 'organismo.jurisdiccion.origen.origen')
    //	  }
    //	}
};
</script>
