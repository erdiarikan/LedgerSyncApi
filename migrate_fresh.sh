#!/bin/bash

echo "Running migrations..."
./vendor/bin/sail artisan migrate:fresh --seed

echo "Creating personal access client..."
OUTPUT=$(./vendor/bin/sail artisan passport:client --personal --name="Laravel Personal Access Client")

SECRET=$(echo "$OUTPUT" | grep "Client secret" | awk -F' ' '{print $NF}')

if [ -n "$SECRET" ]; then
    echo "Updating .env with new client secret..."

    sed -i '' "/PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=/d" .env

    echo "PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=\"$SECRET\"" >> .env
else
    echo "Failed to retrieve client secret. Command Output was:"
    echo "$OUTPUT"
    exit 1
fi

echo "Clearing and optimizing cache..."
./vendor/bin/sail artisan optimize:clear

echo "Passport setup completed successfully!"
