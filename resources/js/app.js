import './bootstrap';
import ApexCharts from 'apexcharts';
import Swal from "sweetalert2";
import { createIcons, icons } from 'lucide';

createIcons({ icons });
window.Swal = Swal;
window.ApexCharts = ApexCharts;
