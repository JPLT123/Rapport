<div>
    <div id="content">
        <div  style="font-family: Arial, sans-serif; margin: 20px;">   
            <div style="border: 1px solid #ccc; padding: 20px; max-width: 800px; margin: 0 auto;">
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
                    <span style="font-weight: bold;">Nom:</span> {{$user->user->name}}
                </div>
        
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Filiale:</span> {{$user->user->filiale->nom}}
                </div>
        
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Département:</span> {{$user->user->departement->nom}}
                </div>
        
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Date:</span> 
                    <td>{{ ($user->date)->format('y-m-d') }}</td>
                </div>
                <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold;">Projet:</span>   
                    {{ $user->tach->projet->nom }}
                </div>
        
                @php
                    $num=1;
                    $nd=1;
                @endphp
                @foreach ($rapports as $item)
        
                    <h4>{{$num++}}- Activités de la journée</h4>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Tâches Prévues:</span>
                        <ul>
                            <li>{{ $item->tach->tache_prevues ?? 'vide'}}</li>
                        </ul>
                    </div>
        
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Tâches Réalisées:</span>
                        <ul>
                            <li>{{ $item->tache_realiser }}</li>
                        </ul>
                    </div>
        
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Tâches Supplémentaires:</span>
                        <ul>
                            <li>{{ $item->tache_suplementaire ?? "pas de tache suplementaires" }}</li>
                        </ul>
                    </div>
        
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Heure de Début:</span>
                        <li>{{ optional($item->debut_heure)->format('h:i A') ?? "pas de debut_heure" }}</li>
                    </div>
        
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Heure de Fin:</span>
                        <li>{{ optional($item->fin_heure)->format('h:i A') ?? "pas de fin_heure" }}</li>
                    </div>
        
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Lieu:</span>
                        {{ $item->lieu ?? "pas de lieu" }},
                    </div>
        
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Matériels Utilisés:</span>
                        {{ $item->materiels_utiliser ?? "pas de materiels utilisés" }},
                    </div>
        
                    <div style="margin-top: 20px;">
                        <span style="font-weight: bold;">Observations:</span>
                        {{ $item->observation ?? "pas d'observation" }}.
                    </div>
                @endforeach
                <br>
                <h4>Depenses des Activités</h4>
                @if ($depenses->isEmpty())
                <p>Pas de dépenses effectuées</p>
                @else
                    <table style="border-collapse: collapse; width: 100%;">
                        <thead style="border-bottom: 2px solid #ddd;">
                            <tr>
                                <th style="padding: 8px; text-align: left;">Designation</th>
                                <th style="padding: 8px; text-align: left;">Coûts Réels</th>
                                <th style="padding: 8px; text-align: left;">Coûts Provisionnels</th>
                                <th style="padding: 8px; text-align: left;">Observations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($depenses as $item)
                                <tr style="border-bottom: 1px solid #ddd;">
                                    <td style="padding: 8px;">{{$item->designation?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam libero quas voluptatem ut ducimus quidem nemo odio pariatur dignissimos? Delectus veritatis deserunt nulla adipisci quas modi accusantium exercitationem beatae culpa.'}}</td>
                                    <td style="padding: 8px;">{{$item->CoutReel}}</td>
                                    <td style="padding: 8px;">{{$item->Coutprevisionnel}}</td>
                                    <td style="padding: 8px;">{{$item->observation}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                @endif
                <br>
                <h4>Taches prevues pour demain</h4>
                @if ($rapports->isEmpty())
                    <p>Pas de rapports disponibles</p>
                @else
                    @foreach ($rapports as $item)
                    <h4>{{$nd++}}- Activités de Demain</h4>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Tâches prevus pour demain:</span>
                        <ul>
                            <li>{{$item->tacheprochain->taches}}</li>
                        </ul>
                    </div>
            
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Durée(en H) :</span>
                        {{($item->tacheprochain->duree)}}
                    </div>
        
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Designation :</span>
                        {{$item->tacheprochain->designation}}
                    </div>
            
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: bold;">Valeur :</span>
                        {{$item->tacheprochain->valeur}}
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <span style="font-weight: bold;">Risques et atténuations :</span>
                        {{$item->tacheprochain->risques}}
                    </div>
                    <div style="margin-top: 20px;">
                        <span style="font-weight: bold;">Observation globale :</span>
                        @foreach ($rapports as $item)
                            {{$item->observationglobal}}
                        @endforeach
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    {{-- <button id="btnConvertir">Convertir en PDF</button> --}}
</div>

<script>
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
</script>
