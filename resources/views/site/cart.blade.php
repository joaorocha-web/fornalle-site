@extends('templates.template')

@section('content')
<div class="container">
    @if(count($cart) > 0)
        <h2>Seu Carrinho</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                    <td>
                        <input type="number" value="{{ $item['quantity'] }}" min="1" 
                               onchange="updateQuantity({{ $item['id'] }}, this.value)">
                    </td>
                    <td>R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                    <td>
                        <button onclick="removeItem({{ $item['id'] }})" class="btn btn-danger">Remover</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2">R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <div class="alert alert-info">Seu carrinho está vazio</div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Intercepta todos os formulários de adicionar ao carrinho
    document.querySelectorAll('form[action="{{ route('cart.add') }}"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Feedback visual
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adicionando...';
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Atualiza o contador do carrinho
                    updateCartCount(data.cart_count);
                    
                    // Mostra feedback visual
                    showToast('Pizza adicionada ao carrinho!', 'success');
                    
                    // Opcional: Atualiza mini-carrinho se existir
                    if (typeof updateMiniCart === 'function') {
                        updateMiniCart(data.cart_items);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Erro ao adicionar ao carrinho', 'error');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
        });
    });
});

// Função para atualizar o contador do carrinho
function updateCartCount(count) {
    const cartCountElements = document.querySelectorAll('.cart-count');
    cartCountElements.forEach(element => {
        element.textContent = count;
        element.classList.remove('d-none');
    });
}

// Função para mostrar notificação
function showToast(message, type = 'success') {
    // Implementação básica - você pode usar Toastify, SweetAlert, etc.
    const toast = document.createElement('div');
    toast.className = `toast show position-fixed bottom-0 end-0 m-3 bg-${type} text-white`;
    toast.style.zIndex = '1100';
    toast.innerHTML = `
        <div class="toast-body">
            ${message}
        </div>
    `;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}
</script>

@endsection