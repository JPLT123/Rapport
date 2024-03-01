<div>
    <div id="content">
        <div  style="font-family: Arial, sans-serif; margin: 20px;">   
            <div style="border: 1px solid #ccc; padding: 30px; max-width: 2000px; margin: 0 auto;">
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
        
                @if ($user->filiale !== null)
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Filiale:</span> {{$user->filiale->nom}}
                    </div>
            
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Département:</span> {{$user->departement->nom}}
                    </div>
                @else
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Filiale:</span> Elceto Holding
                    </div>
            
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Département:</span> {{$user->service->nom}}
                    </div>
                @endif
        
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
                <br>
                <h5 >Rapport Journalier -  {{($rapports->date->format('y/m/d'))}}</h5>
                <br>

            <h6 style="font-size: 16px">Activités prevues :</h6>

            <ul>
                @foreach ($user->planif_hebdomadaires as $planif)
                @if ($rapports->date == $planif->date)
                    @foreach ($planif->plant_taches_relation as $tache)
                        <li style="font-size: 14px">
                            {{ $tache->tache_prevues }}
                        </li>
                    @endforeach
                @endif
                @endforeach
            </ul>
            <br>
            <table style="width:100%; border-collapse:collapse; margin-bottom:10mm; ">
                <tr>
                    <th style="border:1px solid #ccc; text-align:center; background-color: #0055a4; color: white;">Tâches Réalisées</th>
                    @foreach ($taches as $item)
                    <td style="border:1px solid #ccc; text-align:center;">{{ $item->tache_prevues }}</td>
                    @endforeach
                    @foreach ($tachesuples as $item)
                    <td style="border:1px solid #ccc; text-align:center;">{{ $item->tache_prevues }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th style="border:1px solid #ccc; text-align:center; background-color: #0055a4; color: white;">Heure Début</th>
                    @foreach ($rapports->rapports as $item)
                    <td style="border:1px solid #ccc; text-align:center;">{{ ($item->debut_heure)->format('h:i A')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #0055a4; color: white;">Heure Fin</th>
                    @foreach ($rapports->rapports as $item)
                    <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ ($item->fin_heure)->format('h:i A') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th style="border:1px solid #ccc; padding:8px; text-align:center; background-color: #0055a4; color: white;">Lieu</th>
                    @foreach ($rapports->rapports as $item)
                    <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->lieu }}</td>
                    @endforeach
                </tr>

            </table>      
            <h6>Tache Supplémentaires</h6>
            <ul>
                @foreach ($tachesuples as $item)
            <li>
                {{ $item->tache_prevues }}
            </li>
            @endforeach
         </ul>
            <br>
        <table style="width:100%; border-collapse:collapse; margin-bottom:10mm; ">
            <tr>
                <th style="border:1px solid #ccc; padding:8px; text-align:center;background-color: #0055a4; color: white;">materiels utiliser</th>
                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $rapports->materiels_utiliser }}</td>

            </tr>

            <tr>
                <th style="border:1px solid #ccc; padding:8px; text-align:center;background-color: #0055a4; color: white;">Observation des activités</th>
                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $rapports->observation }}</td>

            </tr>
        </table> 
        <br>                
        <h4 style="text-align: center">Depenses des Activités</h4>
        <br>
                
                @if ($depenses->isEmpty())
                <p>Pas de dépenses effectuées</p>
                @else
                    <table style="width: 800px; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #0055a4; color: white;">
                                <th style="width: 200px; border: 1px solid #ccc; padding:8px; text-align:center;">Designations</th>
                                <th style="width: 200px; border: 1px solid #ccc; padding:8px; text-align:center;">Coûts Réels</th>
                                <th style="width: 200px; border: 1px solid #ccc; padding:8px; text-align:center;">Coûts Prévisionnels</th>
                                <th style="width: 200px; border: 1px solid #ccc; padding:8px; text-align:center;">Observations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($depenses as $item)
                            <tr>
                                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->Designation?? 'pas de designation'}}</td>
                    
                                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->CoutReel}}</td>
                    
                                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->Coutprevisionnel}}</td>
                    
                                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{$item->observation}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <br>

                <h4 style="text-align: center">Taches prevues pour demain</h4>
                <br>
                @if (!$rapports)
                    <p>Pas de Taches prevues pour demain</p>
                @else
                <table style="width:100%; border-collapse:collapse; margin-bottom:10mm; ">
                   
                    <tr >
                        <th style="border:1px solid #ccc; padding:8px; text-align:center;background-color: #0055a4; color: white;">Tâches prevus</th>
                        @if ($permission == 'Employer')
                            @foreach ($rapports->tacheprochains as $item)
                                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->taches }}</td>
                            @endforeach
                        @else
                            @foreach ($tacheprochains as $item)
                                <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->tache_prevues }}</td>
                            @endforeach
                        @endif
                    </tr>

                    <tr >
                        <th style="border:1px solid #ccc; padding:8px; text-align:center;background-color: #0055a4; color: white;">Durée(en H)</th>
                        
                        @foreach ($rapports->tacheprochains as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ ($item->duree)->format('h:i A') }}</td>

                        @endforeach
                    </tr>
                    
                    <tr >
                        <th style="border:1px solid #ccc; padding:8px; text-align:center;background-color: #0055a4; color: white;">Designation</th>
                        
                        @foreach ($rapports->tacheprochains as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->designation }}</td>

                        @endforeach
                    </tr>
                    <tr >
                        <th style="border:1px solid #ccc; padding:8px; text-align:center;background-color: #0055a4; color: white;">Valeur</th>
                        
                        @foreach ($rapports->tacheprochains as $item)
                        <td style="border:1px solid #ccc; padding:8px; text-align:center;">{{ $item->valeur }}</td>

                        @endforeach
                    </tr>
                </table> 
                    <table style="width: 800px; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #0055a4; color: white; ">
                                <th style="width: 200px; border: 1px solid #ccc; padding:8px; text-align:center; ">Risques et atténuations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rapports->tacheprochains as $item)
                            <tr>
                            
                                <td style="border:1px solid #ccc; padding:8px; text-align:center; ">{{$item->risques}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <table>
                        <h4 style="text-align: center">Observation globale</h4>
                        <tr>
                            {{$rapports->observationglobal}}
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

