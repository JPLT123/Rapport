<div>
    <div id="content">
        <div  style="font-family: Arial, sans-serif; margin: 20px;">   
            <div style="border: 1px solid #ccc; padding: 30px; max-width: 1000px; margin: 0 auto;">
                <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <img src="{{asset('assets\images\logo_elceto.png')}}" alt="Logo de l'entreprise"  style="max-width: 100%; height: 60px; margin-right: 10px;">
                    <span>Elceto Holding S.A.S</span>
                </div>
                <div class="d-print-none">
                    <div class="float-end">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><span class="m-0">Importer le fichier</span> <i class="fa fa-print"></i></a>
                    </div>
                </div>
                <h2 style="text-align: center;">Rapport d'Avancemant Quotidien</h2>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Nom:</span> {{$user->name}}
                </div>
        
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Filiale:</span> {{$user->filiale->nom}}
                </div>
        
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Département:</span> {{$user->departement->nom}}
                </div>
        
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Date:</span> 
                    @php $dateAffichee = null; @endphp
                    @foreach($rapports as $rapport)
                    <tr>
                        @if($rapport->date != $dateAffichee)
                            <td>{{ ($rapport->date)->format('y-m-d') }}</td>
                            @php $dateAffichee = $rapport->date; @endphp
                        @else
                            <td></td> <!-- cellule vide pour les lignes suivantes avec la même date -->
                        @endif
                    </tr>
                @endforeach
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Projet:</span>   
                    @foreach ($user->planif_hebdomadaires as $item)
                    @php
                        $datePlanification = Carbon\Carbon::parse($item->date)->toDateString(); // Convertit la date de la planification en format 'Y-m-d'
                    @endphp
        
                    @if ($datePlanification == $dateActuelle)
                        {{ $item->projet->nom }}
                    @endif
                    @endforeach
                </div>
        
                <br>
                <h4 style="text-align: center"> Activités de la journée</h4>
                <br>
                <table style="width:100%; border-collapse:collapse; margin-bottom:10mm;">
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center;  background-color: #cbf1ff;">Tâches Prévues</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Tâches Réalisées</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Tâches Supplémentaires</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Heure Début</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Heure Fin</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Lieu</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Matériels Utilisés</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Observations</th>
                        @foreach ($rapports as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tach->tache_prevues }}</td>
                        @endforeach
                    </tr>
                </table>      
                <h4 style="text-align: center">Depenses des Activités</h4>
                <br>
                @if ($depenses->isEmpty())
                <p>Pas de dépenses effectuées</p>
                @else
                    <table style="width:100%; border-collapse:collapse; margin-bottom:10mm;">
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Designation</th>
                            @foreach ($depenses as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->Designation?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam libero quas voluptatem ut ducimus quidem nemo odio pariatur dignissimos? Delectus veritatis deserunt nulla adipisci quas modi accusantium exercitationem beatae culpa.'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Coûts Réels</th>
                            @foreach ($depenses as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->CoutReel}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Coûts previsionnel</th>
                            @foreach ($depenses as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->Coutprevisionnel}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Observation</th>
                            @foreach ($depenses as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->observation}}</td>
                            @endforeach
                        </tr>
                    </table>
                @endif
                <h4 style="text-align: center">Taches prevues pour demain</h4>
                <br>
                @if ($rapports->isEmpty())
                    <p>Pas de rapports disponibles</p>
                @else
                    <table style="width:100%; border-collapse:collapse; margin-bottom:10mm;">
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Tâches prevus pour demain</th>
                            @foreach ($rapports as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->tacheprochain->taches}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Durée(en H)</th>
                            @foreach ($rapports as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{($item->tacheprochain->duree)->format('h:i A')}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Designation</th>
                            @foreach ($rapports as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->tacheprochain->designation}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Valeur</th>
                            @foreach ($rapports as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->tacheprochain->valeur}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #cbf1ff;">Risques et atténuations</th>
                            @foreach ($rapports as $item)
                            <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->tacheprochain->risques}}</td>
                            @endforeach
                        </tr>
                    </table>
                    <table>
                        <h4 style="text-align: center">Observation globale</h4>
                        <tr>
                            @foreach ($rapports as $item)
                                {{$item->observationglobal}}
                            @endforeach
                        </tr>
                    </table>
                @endif
            </div>
        </div>
    </div>
    {{-- <button id="btnConvertir">Convertir en PDF</button> --}}
</div>

{{-- <script>
    document.getElementById('btnConvertir').addEventListener('click', () => {
      const element = document.getElementById('content');
      const options = {
        margin: 10,
        filename: 'document.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
      };
      html2pdf(element, options);
    });
</script> --}}

