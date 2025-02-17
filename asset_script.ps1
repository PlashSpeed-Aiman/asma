
# Start npm run dev
npm run build

# Wait a moment for files to be generated
Start-Sleep -Seconds 5

# Get the CSS file and rename it
Get-ChildItem -Path "public/build/assets" -Filter "*.css" |
    Select-Object -First 1 |
    Rename-Item -NewName "app.css" -Force

# Get the JS file and rename it
Get-ChildItem -Path "public/build/assets" -Filter "*.js" |
    Select-Object -First 1 |
    Rename-Item -NewName "app.js" -Force

Write-Host "Files have been renamed successfully."

