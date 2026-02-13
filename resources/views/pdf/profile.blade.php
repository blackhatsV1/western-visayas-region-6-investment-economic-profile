<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Western Visayas Regional Economic Profile - {{ $year }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #1a1a1a; line-height: 1.4; margin: 0; padding: 0; font-size: 10px; }
        @page { margin: 1cm; }
        
        .header { text-align: center; margin-bottom: 25px; border-bottom: 3px solid #10b981; padding-bottom: 15px; }
        .header h1 { color: #10b981; margin: 0; font-size: 22px; text-transform: uppercase; font-weight: 800; }
        .header p { color: #666; font-size: 11px; margin-top: 4px; font-weight: bold; letter-spacing: 0.1em; }
        
        .section { margin-bottom: 30px; page-break-inside: avoid; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px; }
        .section-title { font-size: 16px; font-weight: bold; color: #10b981; border-left: 6px solid #10b981; padding-left: 12px; margin-bottom: 12px; text-transform: uppercase; }
        
        .description-box { background: #f8fafc; padding: 12px; border-radius: 6px; margin-bottom: 10px; border-left: 3px solid #94a3b8; }
        .description-text { font-size: 11px; color: #334155; }

        /* Stats Grid Styling */
        .stats-grid { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .stats-grid td { width: 50%; padding: 10px; border: 1px solid #e2e8f0; vertical-align: top; }
        .stat-label { font-size: 8px; font-weight: bold; color: #64748b; text-transform: uppercase; display: block; }
        .stat-value { font-size: 15px; font-weight: bold; color: #0f172a; margin-top: 2px; display: block; }
        
        /* Grid Item Styling */
        .grid-item { margin-bottom: 10px; padding: 10px; background: #fff; border: 1px solid #e2e8f0; border-radius: 5px; }
        .grid-item h4 { margin: 0 0 4px 0; color: #10b981; font-size: 12px; text-transform: uppercase; }
        .grid-item p { margin: 0; font-size: 10px; color: #475569; }

        /* Visual CSS Charts */
        .chart-box { background: #fff; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 15px; }
        .chart-title { font-weight: bold; color: #0f172a; font-size: 11px; margin-bottom: 15px; text-transform: uppercase; border-bottom: 1px solid #f1f5f9; padding-bottom: 5px; }
        .chart-row { margin-bottom: 8px; clear: both; }
        .chart-label { width: 150px; float: left; font-size: 9px; color: #475569; height: 14px; line-height: 14px; }
        .chart-bar-container { margin-left: 160px; height: 14px; background: #f1f5f9; border-radius: 2px; position: relative; }
        .chart-bar { position: absolute; left: 0; top: 0; height: 100%; background: #10b981; border-radius: 2px; }
        .chart-value { position: absolute; right: -35px; font-size: 8px; font-weight: bold; color: #0f172a; top: 0; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .data-table th { background: #f8fafc; color: #64748b; font-size: 8px; text-align: left; padding: 5px; border-bottom: 2px solid #e2e8f0; }
        .data-table td { padding: 5px; border-bottom: 1px solid #f1f5f9; font-size: 9px; }

        /* Nested Data */
        .details-wrapper { margin-top: 12px; background: #fdfdfd; border: 1px dashed #10b981; padding: 12px; border-radius: 6px; }
        .details-title { font-weight: 800; font-size: 10px; color: #10b981; margin-bottom: 8px; text-transform: uppercase; }
        .details-item { margin-bottom: 6px; border-bottom: 1px solid #f1f5f9; padding-bottom: 3px; }
        .details-key { font-weight: bold; color: #64748b; }
        .details-val { color: #1e293b; }

        .bullet-list { padding-left: 15px; list-style-type: square; }
        .bullet-list li { margin-bottom: 4px; font-size: 10px; color: #334155; }

        .source { font-size: 8px; color: #94a3b8; font-style: italic; margin-top: 6px; text-align: right; }
        .footer { position: fixed; bottom: -0.5cm; width: 100%; text-align: center; font-size: 8px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>WESTERN VISAYAS REGIONAL ECONOMIC PROFILE</h1>
        <p>{{ $year }} EXECUTIVE REPORT</p>
    </div>

    @foreach($contents->sortBy('page_number') as $content)
        <div class="section">
            <div class="section-title">{{ $content->section_title }}</div>

            @if(isset($content->content['description']) || isset($content->content['notable_info']))
                <div class="description-box">
                    @if(isset($content->content['description']))
                        <div class="description-text">{{ $content->content['description'] }}</div>
                    @endif
                    @if(isset($content->content['notable_info']))
                        <div class="description-text" style="margin-top: 6px; color: #10b981; font-weight: bold;">NOTE: {{ $content->content['notable_info'] }}</div>
                    @endif
                </div>
            @endif

            @if($content->type === 'hero' || $content->type === 'stats_grid')
                @php $stats = $content->type === 'hero' ? ($content->content['highlight_stats'] ?? []) : ($content->content['stats'] ?? []); @endphp
                <table class="stats-grid">
                    @foreach(collect($stats)->chunk(2) as $row)
                        <tr>
                            @foreach($row as $stat)
                                <td>
                                    <span class="stat-label">{{ $stat['label'] }}</span>
                                    <span class="stat-value">{{ $stat['value'] }}</span>
                                </td>
                            @endforeach
                            @if($row->count() == 1) <td></td> @endif
                        </tr>
                    @endforeach
                </table>
            @endif

            @if($content->type === 'list')
                <ul class="bullet-list">
                    @foreach($content->content['items'] ?? [] as $listItem)
                        <li>{{ $listItem }}</li>
                    @endforeach
                </ul>
            @endif

            @if($content->type === 'grid')
                <div>
                    @foreach($content->content['items'] ?? [] as $item)
                        <div class="grid-item">
                            <h4>{{ $item['name'] }}</h4>
                            <p>{{ $item['details'] }}</p>
                            @if(isset($item['modal_details']))
                                <div style="margin-top: 5px; font-size: 9px; color: #64748b; border-top: 1px dotted #e2e8f0; padding-top: 4px;">
                                    @foreach($item['modal_details'] as $mKey => $mVal)
                                        @if($mKey === 'Map Points')
                                            <strong>Key Locations:</strong> {{ implode(', ', array_map(fn($p) => $p['label'], $mVal)) }}
                                        @else
                                            <strong>{{ $mKey }}:</strong> {{ is_array($mVal) ? json_encode($mVal) : $mVal }}
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if($content->type === 'chart')
                <div class="chart-box">
                    <div class="chart-title">{{ $content->content['title'] ?? 'Data Analysis' }}</div>
                    
                    @php
                        $series = $content->content['series'] ?? [];
                        $categories = $content->content['categories'] ?? [];
                        $firstSeriesData = $series[0]['data'] ?? [];
                        $maxVal = !empty($firstSeriesData) ? max(array_map('abs', $firstSeriesData)) : 100;
                        if($maxVal == 0) $maxVal = 1;
                    @endphp

                    @foreach($categories as $index => $cat)
                        @php 
                            $val = $firstSeriesData[$index] ?? 0;
                            $width = min(abs($val) / $maxVal * 100, 100);
                        @endphp
                        <div class="chart-row">
                            <div class="chart-label">{{ $cat }}</div>
                            <div class="chart-bar-container">
                                <div class="chart-bar" style="width: {{ $width }}%; {{ $val < 0 ? 'background: #f87171;' : '' }}"></div>
                                <div class="chart-value">{{ $val }}{{ strpos($content->content['title'] ?? '', '%') !== false ? '%' : '' }}</div>
                            </div>
                        </div>
                    @endforeach
                    <div style="clear: both;"></div>

                    @if(count($series) > 1)
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    @foreach($series as $s) <th>{{ $s['name'] }}</th> @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $index => $cat)
                                    <tr>
                                        <td><strong>{{ $cat }}</strong></td>
                                        @foreach($series as $s) <td>{{ $s['data'][$index] ?? '-' }}</td> @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if(isset($content->content['modal_text']))
                        <p style="font-size: 9px; color: #64748b; margin-top: 10px; border-top: 1px solid #f1f5f9; padding-top: 5px;">{{ $content->content['modal_text'] }}</p>
                    @endif
                </div>
            @endif

            @if(isset($content->content['modal_details']))
                <div class="details-wrapper">
                    <div class="details-title">Detailed Supplementary Data:</div>
                    @foreach($content->content['modal_details'] as $detailKey => $detailVal)
                        <div class="details-item">
                            <span class="details-key">{{ $detailKey }}:</span>
                            <span class="details-val">
                                @php
                                    if (is_array($detailVal)) {
                                        $fParts = [];
                                        foreach($detailVal as $k => $v) {
                                            if (is_array($v)) {
                                                $fParts[] = is_numeric($k) ? json_encode($v) : "$k: " . json_encode($v);
                                            } else {
                                                $fParts[] = is_numeric($k) ? $v : "$k: $v";
                                            }
                                        }
                                        echo implode('; ', $fParts);
                                    } else {
                                        echo $detailVal;
                                    }
                                @endphp
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($content->source)
                <div class="source">Source: {{ $content->source }}</div>
            @endif
        </div>
    @endforeach

    <div class="footer">
        Generated for DTI Western Visayas - &copy; {{ date('Y') }} External Affairs Division
    </div>
</body>
</html>
